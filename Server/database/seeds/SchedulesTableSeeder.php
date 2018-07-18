<?php

use App\Concerns\MapsPeriodDetailsToIdentifier;
use App\Concerns\MapsSectionDetailsToIdentifier;
use App\Database\Seeder\Concerns\ParsesUsisJson;
use App\Period;
use App\Schedule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SchedulesTableSeeder extends Seeder
{
    use ParsesUsisJson, MapsSectionDetailsToIdentifier, MapsPeriodDetailsToIdentifier;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::unguard();

        foreach ($this->yieldSemesterDetails() as $row) {
            $initials = strtoupper($row['data'][3]);

            if (! Str::startsWith(trim($row['data'][8]), ['UB', 'SB', 'OB'])) {
                continue;
            }

            if ($initials === 'TBA') {
                continue;
            }

            try {
                $section = $this->getSectionId($row['year'], $row['session'], $row['data'][2], $initials, $row['data'][4]);
                $period = $this->getPeriodId($this->toShortDay($row['data'][5]), $this->toMilitaryTime($row['data'][6]), $this->toMilitaryTime($row['data'][7]));
            } catch (Exception $e) {
                continue;
            }

            if ($period) {
                $schedule = Schedule::firstOrNew([
                    'section_id' => $section,
                    'period_id' => $period,
                ]);

                $schedule->room = $this->prepareRoomNumber($row['data'][8]);

                if (! $schedule->exists || $schedule->isDirty()) {
                    $schedule->save();
                }
            }
        }

        Schedule::reguard();
    }

    protected function toMilitaryTime($time)
    {
        return date('H:i', strtotime($time));
    }

    protected function toShortDay($day)
    {
        return strtolower(date('D', strtotime($day)));
    }

    protected function prepareRoomNumber($room)
    {
        return preg_replace('/^(?:.*?)([0-9]{5})$/', 'UB$1', $room);
    }

    protected function yieldSemesterDetails()
    {
        foreach (range(2015, 2018) as $year) {
            foreach (['spring', 'summer', 'fall'] as $session) {
                $filename = storage_path('seeds/rooms/' . $year . '/' . $session . '.json');

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
