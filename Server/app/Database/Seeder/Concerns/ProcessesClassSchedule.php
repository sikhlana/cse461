<?php

namespace App\Database\Seeder\Concerns;

trait ProcessesClassSchedule
{
    use ParsesUsisJson;

    protected function yieldSemesterDetails()
    {
        foreach (range(2015, 2018) as $year) {
            foreach (['spring', 'summer', 'fall'] as $session) {
                $filename = storage_path('seeds/class-schedule/' . $year . '/' . $session . '.json');

                if (! file_exists($filename)) {
                    continue;
                }

                foreach ($this->parseJson($filename) as $cell) {
                    yield [
                        'year' => $year,
                        'session' => $session,
                        'data' => $cell,
                    ];
                }
            }
        }
    }
}