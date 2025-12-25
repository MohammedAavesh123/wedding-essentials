<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
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
        'primary_color',
        'secondary_color',
        'accent_color',
        'text_color',
        'background_color',
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

    /**
     * Get all theme colors
     */
    public static function getThemeColors()
    {
        $setting = static::first();
        return $setting ? [
            'primary' => $setting->primary_color ?? '#4F46E5',
            'secondary' => $setting->secondary_color ?? '#10B981',
            'accent' => $setting->accent_color ?? '#F59E0B',
            'text' => $setting->text_color ?? '#1F2937',
            'background' => $setting->background_color ?? '#F9FAFB',
        ] : [
            'primary' => '#4F46E5',
            'secondary' => '#10B981',
            'accent' => '#F59E0B',
            'text' => '#1F2937',
            'background' => '#F9FAFB',
        ];
    }
}
