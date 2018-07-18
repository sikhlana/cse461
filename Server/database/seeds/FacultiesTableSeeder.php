<?php

use App\Concerns\MapsDepartmentShortNameToIdentifier;
use App\Database\Seeder\Concerns\FixesTitleCase;
use App\Database\Seeder\Concerns\ProcessesClassSchedule;
use App\Faculty;
use Illuminate\Database\Seeder;

class FacultiesTableSeeder extends Seeder
{
    use ProcessesClassSchedule, FixesTitleCase, MapsDepartmentShortNameToIdentifier;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faculty::unguard();

        foreach ($this->yieldSemesterDetails() as $row) {
            $initials = strtoupper($row['data'][8]);

            if ($initials === 'TBA') {
                continue;
            }

            $faculty = Faculty::firstOrNew([
                'initials' => $initials,
            ]);

            $faculty->fill([
                'department_id' => $this->getDepartmentId($row['data'][6]),
                'name' => $this->fixTitle($row['data'][7]),
            ]);

            if (! $faculty->exists || $faculty->isDirty()) {
                $faculty->save();
            }
        }

        Faculty::reguard();
    }
}
