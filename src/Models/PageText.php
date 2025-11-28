<?php

namespace Bmb\PageText\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PageText extends Model
{
  protected $fillable = [
    'key',
    'label',
    'text',
  ];

  protected static function booted()
  {
    static::saved(function (PageText $pageText) {
      Cache::forget("page_text_{$pageText->key}");
    });

    static::deleted(function (PageText $pageText) {
      Cache::forget("page_text_{$pageText->key}");
    });
  }
}
