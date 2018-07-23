<?php

use App\Course;
use App\Enrollment;
use App\Student;
use Illuminate\Database\Seeder;

class EnrollmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enrollment::unguard();

        $enrollments = [
            [
                'student' => Student::find(15101045),
                'section' => Course::whereCode('CSE461')->first()->sections()->whereNumber(3)->first(),
            ],
            [
                'student' => Student::find(15101013),
                'section' => Course::whereCode('CSE461')->first()->sections()->whereNumber(2)->first(),
            ],
            [
                'student' => Student::find(15101097),
                'section' => Course::whereCode('CSE461')->first()->sections()->whereNumber(3)->first(),
            ],
            [
                'student' => Student::find(15301133),
                'section' => Course::whereCode('CSE461')->first()->sections()->whereNumber(3)->first(),
            ],
        ];

        foreach ($enrollments as $enr) {
            $enrollment = new Enrollment;

            $enrollment->student()->associate($enr['student']);
            $enrollment->section()->associate($enr['section']);

            $enrollment->save();
        }

        Enrollment::reguard();
    }
}
