<?php

namespace App\Models;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domaine extends Model
{
    use HasFactory;
    public $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

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
