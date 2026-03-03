<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    public $timestamps = false;

    protected $fillable = ['setting_key', 'setting_value', 'type'];

    public static function getByKey(string $key, mixed $default = null): mixed
    {
        $setting = Cache::remember("site_setting_{$key}", 3600, function () use ($key) {
            return static::where('setting_key', $key)->first();
        });

        return $setting ? static::castValue($setting->setting_value, $setting->type) : $default;
    }

    protected static function castValue(mixed $value, ?string $type): mixed
    {
        return match ($type) {
            'boolean' => filter_var($value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($value, true),
            default => $value,
        };
    }
}
