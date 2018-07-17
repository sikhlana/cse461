<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'room',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function startPeriod()
    {
        return $this->belongsTo(Period::class);
    }

    public function endPeriod()
    {
        return $this->belongsTo(Period::class);
    }
}
