<?php

use App\Course;
use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::unguard();

        $courses = [
            [
                'code' => 'CSE422',
                'name' => 'Artificial Intelligence',
            ],
            [
                'code' => 'CSE461',
                'name' => 'Digital System Design',
            ],
            [
                'code' => 'CSE360',
                'name' => 'Computer Interfacing',
            ],
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }

        Course::reguard();
    }
}
