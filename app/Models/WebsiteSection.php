<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Throwable;

class WebsiteSection extends Model
{
    protected $fillable = [
        'key',
        'eyebrow',
        'heading',
        'sub_heading',
        'content',
        'image',
        'is_active',
    ];

    protected function casts(): array
    {
        return ['is_active' => 'boolean'];
    }

    public const CACHE_KEY = 'website_sections.all';

    public static function allCached(): array
    {
        try {
            return Cache::rememberForever(self::CACHE_KEY, function () {
                return static::query()->get()->keyBy('key')->all();
            });
        } catch (Throwable) {
            return [];
        }
    }

    public static function findSection(string $key): ?self
    {
        return self::allCached()[$key] ?? null;
    }

    public static function getValue(string $key, string $field, mixed $default = null): mixed
    {
        $section = self::findSection($key);

        if (! $section) {
            return $default;
        }

        $value = $section->{$field};

        return ($value !== null && $value !== '') ? $value : $default;
    }

    public function getImageUrlAttribute(): string
    {
        return media_url($this->image, 'assets/images/placeholder.svg');
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget(self::CACHE_KEY));
        static::deleted(fn () => Cache::forget(self::CACHE_KEY));
    }
}
