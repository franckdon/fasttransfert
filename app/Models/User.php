<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Services\ActivityLogger;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telephone',
        'domaine_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the domain of the user.
     */
    public function domaine()
    {
        return $this->belongsTo(Domaine::class);
    }

    public static function booted()
    {
        static::created(function ($user) {
            app(ActivityLogger::class)->log('create', $user, [
                'attributes' => $user->getAttributes(),
            ]);
        });

        static::updated(function ($user) {
            app(ActivityLogger::class)->log('update', $user, [
                'attributes' => $user->getChanges(),
            ]);
        });

        static::deleted(function ($user) {
            app(ActivityLogger::class)->log('delete', $user, [
                'attributes' => $user->getAttributes(),
            ]);
        });
    }
}
