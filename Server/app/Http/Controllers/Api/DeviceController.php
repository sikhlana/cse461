<?php

namespace App\Http\Controllers\Api;

use App\Attendance;
use App\Device;
use App\Exceptions\InvalidDigitalIdException;
use App\Schedule;
use App\Section;
use App\Student;
use App\Support\DigitalId;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DeviceController extends Controller
{
    public function record(Request $request, DigitalId $parser)
    {
        $input = $this->validate($request, [
            'qrcode' => 'required_without:rfid|string',
            'rfid' => 'required_without:qrcode|string',
        ]);

        /** @var Device $device */
        $device = $request->user();
        /** @var Student $student */
        $student = null;

        if (! empty($input['qrcode'])) {
            try {
                $student = $parser->getStudentFromString($input['qrcode']);
            } catch (InvalidDigitalIdException $e) {
                return $this->error($e->getMessage());
            }
        } else {
            try {
                $student = Student::whereRfid($input['rfid'])->firstOrFail();
            } catch (ModelNotFoundException $e) {
                return $this->error('Invalid RfID Tag');
            }
        }

        //$now = now();
        $now = Carbon::create(2018, 7, 23, 12, 25, 34);
        $now->setTimezone('Asia/Dhaka');

        /** @var Schedule $schedule */
        $schedule = $device->schedules->first(function (Schedule $sch) use (&$schedule, $now) {
            if (strtolower($now->format('D')) != $sch->day) {
                return false;
            }

            $time = (clone $now)->setTimeFromTimeString($sch->starts_at);
            $time->setTimezone('Asia/Dhaka');

            if (abs($time->timestamp - $now->timestamp) <= 10 * 60) {
                return true;
            }

            return false;
        });

        if (is_null($schedule)) {
            return $this->error('No schedule');
        }

        if (! $enrollment = $this->getStudentEnrollment($student, $schedule->section)) {
            return $this->error('Not enrolled');
        }

        $attendances = Attendance::whereEnrollmentId($enrollment->id)->whereScheduleId($schedule->id)->get();

        if ($attendances->first(function (Attendance $attendance) use ($now) { $time = $attendance->entered_at; return $time->day == $now->day && $time->month == $now->month && $time->year == $now->year;})) {
            return $this->error('Already attended');
        }

        $attendance = new Attendance;
        $attendance->enrollment()->associate($enrollment);
        $attendance->schedule()->associate($schedule);
        $attendance->entered_at = $now;
        $attendance->save();

        return $this->success('Marked present');
    }

    private function getStudentEnrollment(Student $student, Section $section, $checkOtherSections = true)
    {
        foreach ($student->enrollments as $enrollment) {
            if ($enrollment->section->id === $section->id) {
                return $enrollment;
            }
        }

        if ($checkOtherSections) {
            foreach ($section->faculty->sections()->where('course_id', $section->course_id)->get() as $section) {
                if ($enrollment = $this->getStudentEnrollment($student, $section, false)) {
                    return $enrollment;
                }
            }
        }

        return false;
    }

    private function success($message)
    {
        return response()->json([
            'message' => $message,
        ]);
    }

    private function error($message)
    {
        return response()->json([
            'message' => $message,
        ], 400);
    }
}
