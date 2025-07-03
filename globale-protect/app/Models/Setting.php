<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
        'is_public'
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    /**
     * Get a setting value by key
     */
    public static function get($key, $default = null)
    {
        $cacheKey = 'setting_' . $key;

        return Cache::remember($cacheKey, 3600, function () use ($key, $default) {
            $setting = static::where('key', $key)->first();

            if (!$setting) {
                return $default;
            }

            // Handle different types
            switch ($setting->type) {
                case 'boolean':
                    return filter_var($setting->value, FILTER_VALIDATE_BOOLEAN);
                case 'json':
                    return json_decode($setting->value, true);
                case 'image':
                    return $setting->value ? asset('storage/' . $setting->value) : $default;
                default:
                    return $setting->value ?: $default;
            }
        });
    }

    /**
     * Set a setting value
     */
    public static function set($key, $value, $type = 'text', $description = null, $isPublic = false)
    {
        // Handle different value types
        $processedValue = $value;
        if ($type === 'json') {
            $processedValue = json_encode($value);
        } elseif ($type === 'boolean') {
            $processedValue = $value ? '1' : '0';
        }

        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $processedValue,
                'type' => $type,
                'description' => $description,
                'is_public' => $isPublic
            ]
        );

        // Clear cache
        Cache::forget('setting_' . $key);

        return $setting;
    }

    /**
     * Get all public settings for frontend
     */
    public static function getPublic()
    {
        $cacheKey = 'public_settings';

        return Cache::remember($cacheKey, 3600, function () {
            return static::where('is_public', true)->pluck('value', 'key');
        });
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache()
    {
        Cache::flush();
    }
}
