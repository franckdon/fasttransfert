<?php

namespace App\Models;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Demande extends Model
{
    use HasFactory;

    protected $fillable = [
        'reglement_id',
        'demandeur_id',
        'user_id',
    ];

    public function reglement()
    {
        return $this->belongsTo(Reglement::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function demandeur()
    {
        return $this->belongsTo(User::class, 'demandeur_id');
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'demandes_documents')
            ->withPivot('file_path');
    }

    public function historiques()
    {
        return $this->hasMany(Historique::class);
    }

    public function addHistorique($status, $commentaire = null)
    {
        $this->historiques()->create([
            'status' => $status,
            'commentaire' => $commentaire,
        ]);
    }

    public static function booted()
    {
        static::deleting(function ($demande) {
            foreach ($demande->documents as $document) {
                if ($document->pivot->file_path) {
                    Storage::delete($document->pivot->file_path);
                }
            }

            // Supprimer les historiques associés
            $demande->historiques()->delete();

            // Détacher les documents
            $demande->documents()->detach();
        });

        static::created(function ($post) {
            app(ActivityLogger::class)->log('create', $post, [
                'attributes' => $post->getAttributes(),
            ]);
        });

        static::updated(function ($post) {
            app(ActivityLogger::class)->log('update', $post, [
                'attributes' => $post->getChanges(),
            ]);
        });

        static::deleted(function ($post) {
            app(ActivityLogger::class)->log('delete', $post, [
                'attributes' => $post->getAttributes(),
            ]);
        });
    }
}
