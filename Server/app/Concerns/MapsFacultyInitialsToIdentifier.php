<?php

namespace App\Concerns;

use App\Faculty;

trait MapsFacultyInitialsToIdentifier
{
    private static $faculties;

    public function getFacultyId($initials)
    {
        if (! self::$faculties) {
            self::$faculties = Faculty::all()->pluck('id', 'initials');
        }

        return self::$faculties[strtoupper($initials)];
    }
}