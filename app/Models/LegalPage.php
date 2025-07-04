<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LegalPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'content',
        'is_active',
    ];

    protected $casts = [
        'title' => 'array',
        'content' => 'array',
        'is_active' => 'boolean',
    ];

    /**
     * Get the title for the current locale
     */
    public function getTitleAttribute($value)
    {
        $titles = json_decode($value, true);
        $locale = app()->getLocale();
        return $titles[$locale] ?? $titles['en'] ?? '';
    }

    /**
     * Get the content for the current locale
     */
    public function getContentAttribute($value)
    {
        $contents = json_decode($value, true);
        $locale = app()->getLocale();
        return $contents[$locale] ?? $contents['en'] ?? '';
    }

    /**
     * Get a legal page by type
     */
    public static function getByType($type)
    {
        return static::where('type', $type)->where('is_active', true)->first();
    }
}
