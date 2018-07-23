<?php

namespace App\Providers;

use App\Support\Blade;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    protected $composers = [
        '*' => \App\Http\ViewComposers\DefaultComposer::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerComposers();

        Blade::register();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function registerComposers()
    {
        foreach ($this->composers as $key => $value) {
            \View::composer($key, $value);
        }
    }
}
