<?php

namespace Bmb\PageText\Models;

use Illuminate\Database\Eloquent\Model;

class PageText extends Model
{
  protected $fillable = [
    'key',
    'label',
    'text',
  ];
}
