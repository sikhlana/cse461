<?php

namespace App\Http\Concerns;

trait ConfirmsDeleteRequest
{
    protected function constructConfirmsDeleteRequest()
    {
        $this->middleware('confirmed')->only('destroy');
    }
}