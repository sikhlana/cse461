<?php

use App\Semester;
use Illuminate\Database\Seeder;

class SemestersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $displayOrder = 1;

        foreach (range(2015, 2018) as $year) {
            foreach (['spring', 'summer', 'fall'] as $session) {
                Semester::create([
                    'session' => $session,
                    'year' => $year,
                    'display_order' => $displayOrder++,
                ]);
            }
        }
    }
}
