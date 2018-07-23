<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;

    protected $dates = [
        'entered_at', 'exited_at',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
