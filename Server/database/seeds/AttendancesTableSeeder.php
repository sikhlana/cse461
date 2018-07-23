<?php

use App\Attendance;
use App\Enrollment;
use App\Schedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendancesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Attendance::unguard();

        $enrollments = Enrollment::all();
        $now = Carbon::create(2018, 7, 21);
        $date = Carbon::create(2018, 5, 8);

        while ($date->lessThan($now)) {
            $short = strtolower($date->format('D'));

            foreach ($enrollments as $enrollment) {
                $schedules = $enrollment->section->schedules;

                /** @var Schedule $schedule */
                foreach ($schedules as $schedule) {
                    if ($short === $schedule->day) {
                        if (! $this->present()) {
                            continue;
                        }

                        $attendance = new Attendance;
                        $attendance->enrollment()->associate($enrollment);
                        $attendance->schedule()->associate($schedule);

                        $attendance->entered_at = (clone $date)->setTimeFromTimeString($schedule->starts_at)->addMinutes(mt_rand(-10, 10));
                        $attendance->exited_at = (clone $date)->setTimeFromTimeString($schedule->ends_at)->addMinutes(mt_rand(-10, 10));

                        $attendance->save();
                    }
                }
            }

            $date->addDay();
        }

        Attendance::reguard();
    }

    private function present()
    {
        $chances = [
            1, 1, 0, 0, 1, 1, 1, 0, 0, 1, 1, 1, 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0,
        ];

        return (bool) $chances[mt_rand(1, sizeof($chances)) - 1];
    }
}
