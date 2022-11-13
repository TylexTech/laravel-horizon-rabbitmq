<?php

namespace Tylextech\LaravelHorizonRabbitmq;

use Illuminate\Support\ServiceProvider;
use Tylextech\LaravelHorizonRabbitmq\Console\WorkCommand;

class LaravelHorizonRabbitmqServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerCommands();
    }

    /**
     * Register the Horizon Artisan Commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                WorkCommand::class
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Console\WorkCommand::class, function ($app) {
            return new Console\WorkCommand($app['queue.worker'], $app['cache.store']);
        });
    }
}
