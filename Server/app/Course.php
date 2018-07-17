<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'code', 'title', 'credits',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
