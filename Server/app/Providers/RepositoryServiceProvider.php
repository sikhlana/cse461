<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use ReflectionClass;
use Symfony\Component\Finder\Finder;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        //
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws \ReflectionException
     */
    public function boot()
    {
        $paths = [
            app_path('Repositories'),
        ];

        $namespace = $this->app->getNamespace();

        foreach ((new Finder)->in($paths)->files() as $repository) {
            $repository = $namespace . str_replace(['/', '.php'], ['\\', ''], Str::after($repository->getPathname(), app_path() . DIRECTORY_SEPARATOR));

            if (! (new ReflectionClass($repository))->isAbstract()) {
                $this->repositories[] = $repository;
            }
        }

        $this->repositories = array_unique($this->repositories);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $repository) {
            $this->app->singleton($repository);
        }
    }
}
