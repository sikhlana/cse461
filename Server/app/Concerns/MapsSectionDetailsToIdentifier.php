<?php

namespace App\Concerns;

use App\Section;

trait MapsSectionDetailsToIdentifier
{
    use MapsSemesterToIdentifier, MapsCourseCodeToIdentifier, MapsFacultyInitialsToIdentifier;

    private static $sections = [];

    public function getSectionId($year, $session, $course, $faculty, $number)
    {
        $hash = md5(serialize(func_get_args()));

        if (isset(self::$sections[$hash])) {
            return self::$sections[$hash];
        }

        $section = Section::whereCourseId($this->getCourseId($course))
                          ->whereFacultyId($this->getFacultyId($faculty))
                          ->whereSemesterId($this->getSemesterId($year, $session))
                          ->whereNumber(intval($number))
                          ->first(['id']);

        if ($section) {
            self::$sections[$hash] = $section->id;
        }

        return self::$sections[$hash];
    }
}