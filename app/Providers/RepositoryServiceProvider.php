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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $models = array(
            'User', 'Blog', 'Game', 'Review', 'Comment', 'Association'
        );

        foreach ($models as $model) {
            $this->app->bind("App\Repositories\\{$model}Repository", "App\Repositories\\{$model}RepositoryEloquent");
        }
        //$this->app->bind(\App\Repositories\UserRepository::class, \App\Repositories\UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
