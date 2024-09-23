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

    public function questionsObligatoires()
    {
        return $this->hasMany(Question::class)->where('is_required', 1);
    }

    public function questionsOptionnelles()
    {
        return $this->hasMany(Question::class)->where('is_required', 0);
    }

    public function documentsOfQuestionsOptionnelles()
    {
        // return Document::whereHas('questions', function ($query) {
        //     $query->where('is_required', 0)
        //         ->where('reglement_id', $this->id);
        // })->get();
        return $this->hasManyThrough(Document::class, Question::class, 'reglement_id', 'id', 'id', 'document_id')
            ->where('questions.is_required', 0);
    }

    public function demandes()
    {
        return $this->hasMany(Demande::class);
    }

    public function documents()
    {
        return $this->belongsToMany(Document::class, 'reglements_documents')
            ->withPivot('reglement_id', 'document_id', 'is_required')
            ->wherePivot('is_required', 1);
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
