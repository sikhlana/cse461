<?php

use App\Concerns\MapsCourseCodeToIdentifier;
use App\Concerns\MapsFacultyInitialsToIdentifier;
use App\Concerns\MapsSemesterToIdentifier;
use App\Database\Seeder\Concerns\ProcessesClassSchedule;
use App\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    use ProcessesClassSchedule, MapsFacultyInitialsToIdentifier, MapsSemesterToIdentifier, MapsCourseCodeToIdentifier;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::unguard();

        foreach ($this->yieldSemesterDetails() as $row) {
            $initials = strtoupper($row['data'][8]);

            if ($initials === 'TBA') {
                continue;
            }

            $section = Section::firstOrNew([
                'course_id' => $this->getCourseId($row['data'][1]),
                'semester_id' => $this->getSemesterId($row['year'], $row['session']),
                'number' => intval($row['data'][3]),
            ]);

            $section->faculty_id = $this->getFacultyId($initials);
            $section->seats = intval($row['data'][4]);

            if (! $section->exists || $section->isDirty()) {
                $section->save();
            }
        }

        Section::reguard();
    }
}
