<?php

use App\Database\Seeder\Concerns\FixesTitleCase;
use App\Database\Seeder\Concerns\ProcessesClassSchedule;
use App\Department;
use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    use ProcessesClassSchedule, FixesTitleCase;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->yieldSemesterDetails() as $row) {
            Department::firstOrCreate([
                'title' => $this->fixTitle($row['data'][5]),
                'short_name' => strtoupper($row['data'][6]),
            ]);
        }
    }
}
