<?php

namespace App\Support;

use App\Exceptions\InvalidDigitalIdException;
use App\Student;

class DigitalId
{
    public function getStudentFromString($string)
    {
        $data = explode(',', $string);
        $data = array_map('trim', $data);
        $data = array_filter($data);

        if (count($data) <> 4) {
            throw new InvalidDigitalIdException;
        }

        $id = intval($data[1]);
        $this->validateStudentId($id, $data[3]);

        return Student::findOrFail($id);
    }

    private function validateStudentId($studentId, $hash)
    {
        $check = '';

        while ($studentId > 0) {
            $check = $this->decimalToHash($studentId % 10) . $check;
            $studentId = floor($studentId / 10);
        }

        if ($check !== $hash) {
            throw new InvalidDigitalIdException;
        }
    }

    private function decimalToHash($decimal)
    {
        switch ($decimal) {
            case 0:
                return 'ETD';

            case 1:
                return 'A#R';

            case 2:
                return 'B&L';

            case 3:
                return '3M';

            case 4:
                return '5N';

            case 5:
                return 'G7Z';

            case 6:
                return 'L8X';

            case 7:
                return 'U6V';

            case 8:
                return 'CPY';

            case 9:
                return 'WQS';
        }

        throw new InvalidDigitalIdException;
    }
}