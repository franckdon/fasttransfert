<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'is_required',
        'reglement_id',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function reglements()
    {
        return $this->belongsToMany(Reglement::class, 'reglements_documents')
            ->withPivot('is_required')
            ->withTimestamps();
    }

    public function demandes()
    {
        return $this->belongsToMany(Demande::class, 'demandes_documents')
            ->withPivot('file_path')
            ->withTimestamps();
    }
}
