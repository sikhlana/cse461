<?php

namespace App\Database\Seeder\Concerns;

use Illuminate\Support\Str;

trait FixesTitleCase
{
    private static $replacements = [
        'Brac' => 'BRAC',
        'Vlsi' => 'VLSI',
        'Elt' => 'ELT',
        'Esl' => 'ESL',
        ' Of ' => ' of ',
        ' And ' => ' and ',
        ' To ' => ' to ',
        ' For ' => ' for ',
        ' In ' => ' in ',
        ' On ' => ' on ',
        'Ii' => 'II',
        'Iii' => 'III',
        'Iv' => 'IV',
        'Vi' => 'VI',
        'Vii' => 'VII',
        'Viii' => 'VIII',
        'Ix' => 'IX',
        'Cse' => 'CSE',
        'Eee' => 'EEE',
        'Mic' => 'MIC',
        'Mat' => 'MAT',
    ];

    protected function fixTitle($title)
    {
        $title = preg_replace('#\s+#', ' ', $title);
        $title = preg_replace('#([a-z]) ?/ ?([a-z])#i', '$1 / $2', $title);
        $title = preg_replace('#([a-z]{2,})\.([a-z]{2,})#i', '$1. $2', $title);
        $title = strtr($title, [' .' => '.', ' ,' => ',', ' :' => ':']);

        $title = Str::title($title);
        $title = strtr($title, self::$replacements);

        $title = preg_replace_callback('#[A-Z]{2,4}[a-z]+#', function ($matches) {
            return Str::title($matches[0]);
        }, $title);

        $title = preg_replace_callback('/^(.*?) ?\(([a-z]+)\)/i', function ($matches) {
            if (str_word_count($matches[1]) === strlen($matches[2])) {
                $matches[2] = Str::upper($matches[2]);
            }

            return $matches[1] . ' (' . $matches[2] . ')';
        }, $title);

        $title = preg_replace_callback('/(^| )((?:[a-z]\.)+[a-z]\.?)($| )/i', function ($matches) {
            return $matches[1] . Str::upper($matches[2]) . $matches[3];
        }, $title);

        return $title;
    }
}