<?php

namespace App\Models;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'logo',
        'website',
        'phone',
        'address',
    ];

    protected static function booted()
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
