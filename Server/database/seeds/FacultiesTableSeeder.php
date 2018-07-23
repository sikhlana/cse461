<?php

use App\Faculty;
use Illuminate\Database\Seeder;

class FacultiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faculty::unguard();

        $faculties = [
            [
                'initials' => 'KHR',
                'name' => 'Dr. Md. Khalilur Rhaman',
                'email' => 'khalilur@bracu.ac.bd',
                'password' => bcrypt('secret'),
            ],
        ];

        foreach ($faculties as $faculty) {
            Faculty::create($faculty);
        }

        Faculty::reguard();
    }
}
