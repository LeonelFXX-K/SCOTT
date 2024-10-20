<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = [
        'image_url',
        'number',
        'number_oktv',
        'name',
        'oktv_url'
    ];
}
