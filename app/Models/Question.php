<?php

namespace App\Models;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'intitule',
        'reglement_id',
    ];

    public function reglement()
    {
        return $this->belongsTo(Reglement::class);
    }

    public static function booted()
    {
        static::created(function ($question) {
            app(ActivityLogger::class)->log('create', $question, [
                'attributes' => $question->getAttributes(),
            ]);
        });

        static::updated(function ($question) {
            app(ActivityLogger::class)->log('update', $question, [
                'attributes' => $question->getChanges(),
            ]);
        });

        static::deleted(function ($question) {
            app(ActivityLogger::class)->log('delete', $question, [
                'attributes' => $question->getAttributes(),
            ]);
        });
    }
}
