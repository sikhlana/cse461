<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use stdClass;

class DefaultComposer
{
    public function compose(View $view)
    {
        $app = new stdClass();

        $app->visitor = auth()->check() ? auth()->user() : optional();
        $app->route = optional(request()->route())->getName();

        $view->with(compact([
            'app',
        ]));
    }
}