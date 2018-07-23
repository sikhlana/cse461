<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Attendance
 *
 * @property int $id
 * @property int $enrollment_id
 * @property int $schedule_id
 * @property \Carbon\Carbon|null $entered_at
 * @property \Carbon\Carbon|null $exited_at
 * @property-read \App\Enrollment $enrollment
 * @property-read \App\Schedule $schedule
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attendance whereEnrollmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attendance whereEnteredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attendance whereExitedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attendance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Attendance whereScheduleId($value)
 */
	class Attendance extends \Eloquent {}
}

namespace App{
/**
 * App\Course
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Section[] $sections
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Course whereName($value)
 */
	class Course extends \Eloquent {}
}

namespace App{
/**
 * App\Device
 *
 * @property int $id
 * @property string $serial
 * @property string $api_token
 * @property string $room
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Schedule[] $schedules
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereSerial($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Device whereUpdatedAt($value)
 */
	class Device extends \Eloquent {}
}

namespace App{
/**
 * App\Enrollment
 *
 * @property int $id
 * @property int $student_id
 * @property int $section_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attendance[] $attendances
 * @property-read \App\Section $section
 * @property-read \App\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enrollment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enrollment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enrollment whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enrollment whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Enrollment whereUpdatedAt($value)
 */
	class Enrollment extends \Eloquent {}
}

namespace App{
/**
 * App\Faculty
 *
 * @property int $id
 * @property string $initials
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Section[] $sections
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereInitials($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Faculty whereUpdatedAt($value)
 */
	class Faculty extends \Eloquent {}
}

namespace App{
/**
 * App\Schedule
 *
 * @property int $id
 * @property int $section_id
 * @property string $day
 * @property string $starts_at
 * @property string $ends_at
 * @property string $room
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Attendance[] $attendances
 * @property-read \App\Section $section
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereEndsAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereRoom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereSectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Schedule whereStartsAt($value)
 */
	class Schedule extends \Eloquent {}
}

namespace App{
/**
 * App\Section
 *
 * @property int $id
 * @property int $course_id
 * @property int $faculty_id
 * @property int $number
 * @property-read \App\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Enrollment[] $enrollments
 * @property-read \App\Faculty $faculty
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Schedule[] $schedules
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Student[] $students
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Section whereNumber($value)
 */
	class Section extends \Eloquent {}
}

namespace App{
/**
 * App\Student
 *
 * @property int $id
 * @property string $name
 * @property string|null $rfid
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Enrollment[] $enrollments
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Section[] $sections
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereRfid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Student whereUpdatedAt($value)
 */
	class Student extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

