<?php

namespace App;

use Cog\Flag\Traits\Classic\HasVerifiedAt;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasVerifiedAt;

    public $timestamps = false;

    protected $dates = [
        'entered_at', 'exited_at', 'verified_at',
    ];

    public function entered()
    {
        $this->setAttribute('entered_at', now());

        return $this;
    }

    public function exited()
    {
        $this->setAttribute('exited_at', now());

        return $this;
    }

    public function hasEntered()
    {
        return ! is_null($this->getAttribute('entered_at'));
    }

    public function hasExited()
    {
        return ! is_null($this->getAttribute('exited_at'));
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
