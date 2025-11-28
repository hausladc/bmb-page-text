<?php

use Bmb\PageText\Models\PageText;

if (!function_exists('page_text')) {
    function page_text(string $key, string $fallback = '')
    {
        return cache()->remember("page_text_{$key}", 3600, function () use ($key, $fallback) {
            return PageText::where('key', $key)->value('text') ?? $fallback;
        });
    }
}
