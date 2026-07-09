<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $connection = 'sqlite'; // Use the SQLite connection for this model

    protected $primaryKey = 'name'; // Set the primary key to 'name'

    public $incrementing = false; // Disable auto-incrementing for the primary key

    protected $keyType = 'string'; // Set the key type to string

    protected $fillable = ['name', 'value', 'group', 'cached'];

    public static function getValue(string $name, $default = null)
    {
        $value = Cache::get("setting_{$name}");
        if ($value === null) {
            $setting = self::query()->find($name);
            if ($setting && $setting->cached) {
                Cache::put("setting_{$name}", $setting->value);
            }
            $value = $setting?->value ?? $default;
        }
        return $value;
    }

    public static function setValue(string $name, $value, bool $cached = true): void
    {
        $setting = self::query()->find($name);
        if ($setting) {
            $setting->value = $value;
            $setting->cached = $cached;
            $setting->save();
        } else {
            self::query()->create([
                'name' => $name,
                'value' => $value,
                'cached' => $cached,
            ]);
        }

        if ($cached) {
            Cache::put("setting_{$name}", $value);
        } else {
            Cache::forget("setting_{$name}");
        }
    }
}