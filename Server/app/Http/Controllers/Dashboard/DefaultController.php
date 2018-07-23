<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DefaultController extends Controller
{
    public function showHomePage()
    {
        $sections = $this->visitor->sections->sortBy('course.code');

        return view('dashboard.home', compact([
            'sections',
        ]));
    }
}
