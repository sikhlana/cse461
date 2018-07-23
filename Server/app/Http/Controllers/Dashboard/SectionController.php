<?php

namespace App\Http\Controllers\Dashboard;

use App\Attendance;
use App\Section;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    public function showAttendancePage(Section $section)
    {
        $students = $section->students->sortBy('id');
        $attendances = [];

        $date = Carbon::create(2018, 5, 8); // start of semester.
        $end = now();

        while ($date->lessThan($end)) {
            $short = strtolower($date->format('D'));

            foreach ($section->enrollments as $enrollment) {
                foreach ($enrollment->attendances as $attendance) {
                    $schedule = $attendance->schedule;

                    if ($short !== $schedule->day) {
                        continue;
                    }

                    if (isset($attendances[$date->timestamp])) {
                        $attn = $attendances[$date->timestamp];
                    } else {
                        $attn = [
                            'date' => clone $date,
                            'students' => collect(),
                        ];
                    }

                    if ($attendance->entered_at->year === $date->year &&
                        $attendance->entered_at->month === $date->month &&
                        $attendance->entered_at->day === $date->day
                    ) {
                        $student = $enrollment->student;
                        $attn['students']->put($student->id, $student);
                    }

                    $attendances[$date->timestamp] = $attn;
                }
            }

            $date->addDay();
        }

        $attendances = collect($attendances);

        if ($attendances->isEmpty()) {
            $rate = 0;
        } else {
            $rate = value(function () use ($attendances, $students) {
                $expected = $attendances->count() * $students->count();
                $actual = 0;

                foreach ($attendances as $attendance) {
                    $actual += $attendance['students']->count();
                }

                return round(($actual / $expected) * 100, 2);
            });
        }

        return view('dashboard.section.attendance')->with(compact([
            'section', 'attendances', 'students', 'rate',
        ]));
    }
}
