<?php

namespace App\Models;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reglement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'reglements_documents')
            ->withPivot('is_required', true);
    }

    public function complementaryDocuments()
    {
        return $this->belongsToMany(Document::class, 'question_document')
            ->withPivot('is_complementary', true);
    }

    public static function booted()
    {

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
