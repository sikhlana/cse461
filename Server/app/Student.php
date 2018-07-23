<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public $incrementing = false;

    protected $fillable = [
        'id', 'name', 'rfid',
    ];

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'enrollments');
    }
}
