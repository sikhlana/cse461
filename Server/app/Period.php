<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'day', 'starts_at', 'ends_at',
        'ramadan_starts_at', 'ramadan_ends_at',
    ];
}
