<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'site_name',
        'site_logo',
        'contact_email',
        'contact_phone',
        'address',
        'facebook_url',
        'instagram_url',
        'twitter_url',
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $setting = static::first();
        return $setting ? ($setting->$key ?? $default) : $default;
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value)
    {
        $setting = static::firstOrCreate([]);
        $setting->$key = $value;
        $setting->save();
        return $setting;
    }
}
