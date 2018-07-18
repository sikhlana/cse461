<?php

use App\Period;
use Illuminate\Database\Seeder;

class PeriodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $timings = [
            [
                'starts_at' => '08:00',
                'ends_at' => '09:20',
                'ramadan_starts_at' => '08:15',
                'ramadan_ends_at' => '9:20',
            ],
            [
                'starts_at' => '09:30',
                'ends_at' => '10:50',
                'ramadan_starts_at' => '09:30',
                'ramadan_ends_at' => '10:35',
            ],
            [
                'starts_at' => '11:00',
                'ends_at' => '12:20',
                'ramadan_starts_at' => '10:45',
                'ramadan_ends_at' => '11:50',
            ],
            [
                'starts_at' => '12:30',
                'ends_at' => '13:50',
                'ramadan_starts_at' => '12:00',
                'ramadan_ends_at' => '13:05',
            ],
            [
                'starts_at' => '14:00',
                'ends_at' => '15:20',
                'ramadan_starts_at' => '13:15',
                'ramadan_ends_at' => '14:20',
            ],
            [
                'starts_at' => '15:30',
                'ends_at' => '16:50',
                'ramadan_starts_at' => '14:30',
                'ramadan_ends_at' => '15:35',
            ],
            [
                'starts_at' => '17:00',
                'ends_at' => '18:20',
                'ramadan_starts_at' => '15:45',
                'ramadan_ends_at' => '16:50',
            ],
        ];

        foreach (['sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat'] as $day) {
            foreach ($timings as $timing) {
                Period::create(array_merge($timing, [
                    'day' => $day,
                ]));
            }
        }
    }
}
