<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'day', 'starts_at', 'ends_at', 'room',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
