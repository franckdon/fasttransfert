<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }


    public static function set($key, $value)
    {
        // Supprimer l'entrée du cache pour qu'elle soit rechargée
        Cache::forget('settings_' . $key);

        return static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
