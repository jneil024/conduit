<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    /**
     * Retrieve a setting value by key with optional default.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $setting = Cache::rememberForever("setting.{$key}", function () use ($key) {
            return static::where('key', $key)->first();
        });

        // Handle legacy string cache from previous version
        if (is_string($setting)) {
            Cache::forget("setting.{$key}");
            $setting = static::where('key', $key)->first();
        }

        if (! $setting) {
            return $default;
        }

        $value = is_array($setting) ? ($setting['value'] ?? null) : ($setting->value ?? null);
        $type = is_array($setting) ? ($setting['type'] ?? 'text') : ($setting->type ?? 'text');

        if (is_null($value) || $value === '') {
            return $default;
        }

        if ($type === 'image') {
            return static::resolveImageUrl($value, $default);
        }

        return $value;
    }

    /**
     * Resolve an image setting value to a browser-accessible URL.
     */
    public static function resolveImageUrl(?string $value, mixed $default = null): ?string
    {
        if (empty($value)) {
            return $default;
        }

        if (Str::startsWith($value, ['http://', 'https://', 'data:'])) {
            return $value;
        }

        if (Str::startsWith($value, ['images/', 'assets/'])) {
            return asset($value);
        }

        $cleanPath = Str::startsWith($value, 'storage/')
            ? $value
            : 'storage/' . ltrim($value, '/');

        return asset($cleanPath);
    }

    /**
     * Set or update a setting value.
     */
    public static function set(string $key, mixed $value, string $type = 'text', string $group = 'general'): self
    {
        $setting = static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
                'group' => $group,
            ]
        );

        Cache::forget("setting.{$key}");

        return $setting;
    }

    /**
     * Clear all cached settings.
     */
    public static function clearCache(): void
    {
        $keys = static::pluck('key');
        foreach ($keys as $key) {
            Cache::forget("setting.{$key}");
        }
        try {
            Cache::flush();
        } catch (\Throwable $e) {
            // driver does not support flush or already empty
        }
    }
}
