<?php

use App\Student;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::unguard();

        $students = [
            [
                'id' => 15101045,
                'name' => 'A M Saif Mahmud',
                'rfid' => '03:45:77:89',
            ],
            [
                'id' => 15101013,
                'name' => 'Tanjida Sultana',
                'rfid' => '80:AE:F5:A3',
            ],
            [
                'id' => 15101097,
                'name' => 'Aquib Jawad',
                'rfid' => 'FE:9F:79:89',
            ],
            [
                'id' => 15301133,
                'name' => 'MD Towhidul Islam',
                'rfid' => 'D6:37:79:89',
            ],
            [
                'id' => 16101135,
                'name' => 'MD Nazmus Sabab',
                'rfid' => 'B5:B6:7A:89',
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }

        Student::reguard();
    }
}
