<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($page) {
            $page->slug = Str::slug($page->title);
            $count = static::whereRaw("slug RLIKE '^{$page->slug}(-[0-9]+)?$'")->count();
            if ($count > 0) {
                $page->slug .= '-'.($count + 1);
            }
        });
    }
}
