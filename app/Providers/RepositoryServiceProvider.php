<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $models = [
            'User'
        ];

        // phpcs:disable
        foreach ($models as $model) {
            $this->app->singleton(
                "App\Repositories\\{$model}\\{$model}RepoInterface",
                "App\Repositories\\{$model}\\{$model}Repo"
            );
        }
        // phpcs:enable
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
