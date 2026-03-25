<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;

class ShopSetting extends Model
{
    protected $table = 'shop_settings';

    protected $fillable = [
        'key',
        'value',
    ];

    public const KEY_PUBLIC_DISABLED = 'public_disabled';
    public const KEY_PUBLIC_STATUS_CONTENT = 'public_status_content';

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return static::query()->where('key', $key)->value('value') ?? $default;
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::query()->updateOrCreate(
            ['key' => $key],
            ['value' => is_bool($value) ? ($value ? '1' : '0') : (string) $value]
        );
    }

    public static function getBool(string $key, bool $default = false): bool
    {
        $value = static::getValue($key, $default ? '1' : '0');

        if (is_bool($value)) {
            return $value;
        }

        if ($value === null) {
            return false;
        }

        $normalized = strtolower(trim((string) $value));

        if (in_array($normalized, ['0', 'false', 'off', 'no', 'n'], true)) {
            return false;
        }

        return in_array($normalized, ['1', 'true', 'on', 'yes', 'y'], true);
    }

    public static function getJson(string $key, array $default = []): array
    {
        $value = static::getValue($key);

        if (! is_string($value) || trim($value) === '') {
            return $default;
        }

        $decoded = json_decode($value, true);

        return is_array($decoded) ? $decoded : $default;
    }

    public static function setJson(string $key, array $value): void
    {
        static::setValue($key, json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
    }

    public static function getPublicStatusContent(?string $locale = null): array
    {
        $locale ??= App::currentLocale();

        $defaults = static::getDefaultPublicStatusContent($locale);
        $content = static::getJson(static::KEY_PUBLIC_STATUS_CONTENT);
        $localized = is_array($content[$locale] ?? null) ? $content[$locale] : [];

        return [
            'title' => isset($localized['title']) && is_string($localized['title']) && trim($localized['title']) !== ''
                ? $localized['title']
                : $defaults['title'],
            'text' => isset($localized['text']) && is_string($localized['text']) && trim($localized['text']) !== ''
                ? $localized['text']
                : $defaults['text'],
            'note' => isset($localized['note']) && is_string($localized['note']) && trim($localized['note']) !== ''
                ? $localized['note']
                : $defaults['note'],
        ];
    }

    public static function getEditablePublicStatusContent(): array
    {
        $stored = static::getJson(static::KEY_PUBLIC_STATUS_CONTENT);
        $result = [];

        foreach (config('app.supported_locales', ['ru', 'ro', 'en']) as $locale) {
            $defaults = static::getDefaultPublicStatusContent($locale);
            $localized = is_array($stored[$locale] ?? null) ? $stored[$locale] : [];

            $result[$locale] = [
                'title' => is_string($localized['title'] ?? null) ? $localized['title'] : $defaults['title'],
                'text' => is_string($localized['text'] ?? null) ? $localized['text'] : $defaults['text'],
                'note' => is_string($localized['note'] ?? null) ? $localized['note'] : $defaults['note'],
            ];
        }

        return $result;
    }

    private static function getDefaultPublicStatusContent(string $locale): array
    {
        $defaults = Lang::get('maintenance', [], $locale);

        return [
            'title' => is_string($defaults['title'] ?? null) ? $defaults['title'] : '',
            'text' => is_string($defaults['text'] ?? null) ? $defaults['text'] : '',
            'note' => is_string($defaults['note'] ?? null) ? $defaults['note'] : '',
        ];
    }
}
