<?php

namespace App\Models;

use App\Services\ActivityLogger;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'properties',
    ];

    protected $casts = [
        'properties' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPropertiesAttribute($value)
    {
        return json_decode($value);
    }

    public function getDescriptionAttribute()
    {
        $action = $this->action;
        $entity = $this->entity_type;
        $entityId = $this->entity_id;
        $createdAt = $this->created_at->diffForHumans();
        $user = $this->user->name ?? 'Nouvel utilisateur';

        if ($action === 'create') {
            $action = 'a crée';
        } elseif ($action === 'update') {
            $action = 'a modifié';
        } elseif ($action === 'delete') {
            $action = 'a supprimé';
        }

        if ($entity === 'App\Models\Demande') {
            $entity = 'une demande';
        } elseif ($entity === 'App\Models\Reglement') {
            $entity = 'un reglement';
        } elseif ($entity === 'App\Models\Question') {
            $entity = 'une question';
        } elseif ($entity === 'App\Models\ActivityLog') {
            $entity = 'une activité';
        } elseif ($entity === 'App\Models\Domaine') {
            $entity = 'un secteur d\'activité';
        } else if ($entity === 'App\Models\User') {
            $entity = 'un utilisateur';
        } else {
            $entity = 'une entité';
        }
        if ($user === 'Nouvel utilisateur') {
            return "Un nouveau compte a été créé il y a {$createdAt}";
        } else {
            return "{$user} {$action} {$entity} #{$entityId} il y a {$createdAt}";
        }
    }

    public static function booted()
    {
        static::deleted(function ($log) {
            app(ActivityLogger::class)->log('delete', $log, [
                'attributes' => $log->getAttributes(),
            ]);
        });
    }
}
