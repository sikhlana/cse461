<?php

namespace App\Concerns;

use App\Semester;

trait MapsSemesterToIdentifier
{
    private static $semesters;

    public function getSemesterId($year, $session = null)
    {
        if (is_null($session)) {
            $year = explode('-', $year);

            $session = $year[0];
            $year = $year[1];
        }

        if (! self::$semesters) {
            self::$semesters = Semester::all()->map(function ($value) {
                return ['id' => $value['id'], 'session' => $value['session'] . '-' . $value['year']];
            })->pluck('id', 'session');
        }

        return self::$semesters[$session . '-' . $year];
    }
}