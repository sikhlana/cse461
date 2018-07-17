<?php

namespace App\Concerns;

use App\Course;

trait MapsCourseCodeToIdentifier
{
    private static $courses;

    public function getCourseId($code)
    {
        if (! self::$courses) {
            self::$courses = Course::all()->pluck('id', 'code');
        }

        return self::$courses[strtoupper($code)];
    }
}