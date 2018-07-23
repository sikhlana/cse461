<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $timestamps = false;

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
