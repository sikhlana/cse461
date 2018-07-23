<?php

use App\Course;
use App\Faculty;
use App\Section;
use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::unguard();

        $sections = [
            [
                'course' => Course::whereCode('CSE461')->first(),
                'faculty' => Faculty::whereInitials('KHR')->first(),
                'number' => 1,
            ],
            [
                'course' => Course::whereCode('CSE461')->first(),
                'faculty' => Faculty::whereInitials('KHR')->first(),
                'number' => 2,
            ],
            [
                'course' => Course::whereCode('CSE461')->first(),
                'faculty' => Faculty::whereInitials('KHR')->first(),
                'number' => 3,
            ],
            [
                'course' => Course::whereCode('CSE360')->first(),
                'faculty' => Faculty::whereInitials('KHR')->first(),
                'number' => 1,
            ],
        ];

        foreach ($sections as $sec) {
            $section = new Section;
            $section->number = $sec['number'];

            $section->course()->associate($sec['course']);
            $section->faculty()->associate($sec['faculty']);

            $section->save();
        }

        Section::reguard();
    }
}
