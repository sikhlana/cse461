<?php

use App\Concerns\MapsDepartmentShortNameToIdentifier;
use App\Course;
use App\Database\Seeder\Concerns\FixesTitleCase;
use App\Database\Seeder\Concerns\ProcessesClassSchedule;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    use ProcessesClassSchedule, FixesTitleCase, MapsDepartmentShortNameToIdentifier;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::unguard();

        $credits = [];

        foreach ($this->parseJson(storage_path('seeds/courses.json')) as $cell) {
            $credits[strtoupper($cell[2])] = floatval($cell[4]);
        }

        foreach ($this->yieldSemesterDetails() as $row) {
            $code = strtoupper($row['data'][1]);

            $course = Course::firstOrNew([
                'code' => $code,
            ]);

            $course->fill([
                'department_id' => $this->getDepartmentId($row['data'][6]),
                'title' => $this->fixTitle($row['data'][2]),
                'credits' => $credits[$code],
            ]);

            if (! $course->exists || $course->isDirty()) {
                $course->save();
            }
        }

        Course::reguard();
    }
}
