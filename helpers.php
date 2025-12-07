<?php

use Bmb\PageText\Models\PageText;

if (!function_exists('page_text')) {
    function page_text(string $key, $strip_tags = false, string $fallback = '', array $replacements = []): string
    {
        $text = cache()->remember("page_text_{$key}", 3600, function () use ($key, $fallback) {
            return PageText::where('key', $key)->value('text') ?? $fallback;
        });

        if (!empty($replacements)) {
            $text = preg_replace_callback('/{{\s*(.*?)\s*}}/', function ($matches) use ($replacements) {
                $path = $matches[1];
                $value = get_from_path($replacements, $path);
                return $value ?? $matches[0];
            }, $text);
        }

        return $strip_tags ? strip_tags($text) : $text;
    }

    function get_from_path(array $data, string $path)
    {
        $keys = explode('.', $path);
        $value = $data;

        foreach ($keys as $key) {
            if (is_array($value) && array_key_exists($key, $value)) {
                $value = $value[$key];
            } elseif (is_object($value) && isset($value->{$key})) {
                $value = $value->{$key};
            } else {
                return null;
            }
        }

        return $value;
    }
}
