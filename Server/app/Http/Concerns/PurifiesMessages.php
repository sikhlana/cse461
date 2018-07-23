<?php

namespace App\Http\Concerns;

use Purify;

trait PurifiesMessages
{
    protected function purify($message)
    {
        static $init = false;
        $purifier = Purify::getPurifier();

        if (! $init) {
            $def = $purifier->config->getHTMLDefinition(true);
            $def->addAttribute('pre', 'spellcheck', 'Bool');
            $def->addAttribute('iframe', 'allowfullscreen', 'Bool');
            $def->addAttribute('table', 'table_id', 'Text');
            $def->addAttribute('tr', 'row_id', 'Text');
            $def->addAttribute('td', 'table_id', 'Text');
            $def->addAttribute('td', 'row_id', 'Text');
            $def->addAttribute('td', 'cell_id', 'Text');

            $init = true;
        }

        return $purifier->purify($message);
    }
}