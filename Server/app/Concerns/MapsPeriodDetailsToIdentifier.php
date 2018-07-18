<?php

namespace App\Concerns;

use App\Period;

trait MapsPeriodDetailsToIdentifier
{
    private static $periods;

    public function getPeriodId($day, $startsAt, $endsAt)
    {
        if (! self::$periods) {
            self::$periods = Period::all()->map(function ($value) {
                return ['id' => $value['id'], 'period' => $value['day'] . '-' . $value['starts_at'] . '-' . $value['ends_at']];
            })->pluck('id', 'period');
        }

        if (isset(self::$periods[$day . '-' . $startsAt . '-' . $endsAt])) {
            return self::$periods[$day . '-' . $startsAt . '-' . $endsAt];
        }

        return null;
    }
}