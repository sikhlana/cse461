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
        $this->call(PeriodsTableSeeder::class);
        $this->call(SemestersTableSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(FacultiesTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(SectionsTableSeeder::class);
        $this->call(SchedulesTableSeeder::class);
    }
}
