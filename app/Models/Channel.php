<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage;

class Channel extends Model
{
    protected $fillable = [
        'image_url',
        'number',
        'number_oktv',
        'name',
        'url',
        'category',
        'status',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn() => Storage::url($this->image_url),
        );
    }
}
