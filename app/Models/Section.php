<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'key',
        'name',
        'type',
        'title',
        'content',
        'data',
        'image',
        'is_active',
        'sort_order'
    ];

    protected $casts = [
        'data' => 'array',
        'is_active' => 'boolean'
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($section) {
            // Automatically set key based on type if not already set
            if (empty($section->key) && !empty($section->type)) {
                $section->key = $section->type;
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }
}
