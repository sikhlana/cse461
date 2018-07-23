<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'room',
    ];

    protected $with = [
        'course', 'schedules',
    ];

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }
}
