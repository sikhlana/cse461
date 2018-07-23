<?php

use App\Course;
use App\Schedule;
use App\Section;
use Illuminate\Database\Seeder;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::unguard();

        $schedules = [
            [
                'section' => Course::whereCode('CSE461')->first()->sections()->whereNumber(2)->first(),
                'day' => 'mon',
                'starts_at' => '11:00 AM',
                'ends_at' => '12:20 PM',
                'room' => 'UB30501'
            ],
            [
                'section' => Course::whereCode('CSE461')->first()->sections()->whereNumber(2)->first(),
                'day' => 'wed',
                'starts_at' => '11:00 AM',
                'ends_at' => '12:20 PM',
                'room' => 'UB30501'
            ],
            [
                'section' => Course::whereCode('CSE461')->first()->sections()->whereNumber(3)->first(),
                'day' => 'mon',
                'starts_at' => '12:30 PM',
                'ends_at' => '02:00 PM',
                'room' => 'UB30501'
            ],
            [
                'section' => Course::whereCode('CSE461')->first()->sections()->whereNumber(3)->first(),
                'day' => 'wed',
                'starts_at' => '12:30 PM',
                'ends_at' => '02:00 PM',
                'room' => 'UB30501'
            ],
        ];

        foreach ($schedules as $sch) {
            $schedule = new Schedule;

            $schedule->section()->associate($sch['section']);
            unset ($sch['section']);

            $schedule->fill($sch);
            $schedule->save();
        }

        Schedule::reguard();
    }
}
