<?php

use Bmb\PageText\Models\PageText;

if (!function_exists('page_text')) {
    function page_text(string $key, $strip_tags = false, string $fallback = '')
    {
        return cache()->remember("page_text_{$key}", 3600, function () use ($key, $strip_tags, $fallback) {
            $pageText = PageText::where('key', $key)->value('text') ?? $fallback;
            return $strip_tags ? strip_tags($pageText) : $pageText;
        });
    }
}
