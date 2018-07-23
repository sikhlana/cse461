<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(DevicesTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
        $this->call(StudentsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
        $this->call(EnrollmentsTableSeeder::class);
        $this->call(AttendancesTableSeeder::class);
    }
}
