<?php

namespace App\Concerns;

use App\Department;

trait MapsDepartmentShortNameToIdentifier
{
    private static $departments;

    public function getDepartmentId($code)
    {
        if (! self::$departments) {
            self::$departments = Department::all()->pluck('id', 'short_name');
        }

        return self::$departments[strtoupper($code)];
    }
}