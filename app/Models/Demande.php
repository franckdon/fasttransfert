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

    public function lastHistory()
    {
        return $this->hasOne(Historique::class)->latestOfMany();
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

        static::created(function ($demande) {
            app(ActivityLogger::class)->log('create', $demande, [
                'attributes' => $demande->getAttributes(),
            ]);
        });

        static::updated(function ($demande) {
            app(ActivityLogger::class)->log('update', $demande, [
                'attributes' => $demande->getChanges(),
            ]);
        });

        static::deleted(function ($demande) {
            app(ActivityLogger::class)->log('delete', $demande, [
                'attributes' => $demande->getAttributes(),
            ]);
        });
    }
}
