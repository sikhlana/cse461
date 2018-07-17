<?php

namespace App\Database\Seeder\Concerns;

trait ParsesUsisJson
{
    protected function parseJson($filename)
    {
        static $cached = [];

        if (isset($cached[$filename])) {
            $data = $cached[$filename];
        } else {
            $data = @json_decode(file_get_contents($filename), true);

            if (is_array($data)) {
                $data = collect($data['rows'])->pluck('cell');
            } else {
                $data = [];
            }

            $cached[$filename] = $data;
        }

        if (empty($data)) {
            return;
        }

        foreach ($data as $cell) {
            yield $cell;
        }
    }
}