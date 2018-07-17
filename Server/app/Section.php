<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'number',
    ];

    protected $with = [
        'course', 'faculty', 'semester',
        'schedules',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}
