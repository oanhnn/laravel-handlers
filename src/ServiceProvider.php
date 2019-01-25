<?php

namespace Laravel\Handlers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package     Laravel\Handlers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // register config
        $this->mergeConfigFrom(dirname(__DIR__) . '/config/handlers.php', 'handlers');

        // register commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                Commands\MakeHandler::class,
            ]);
        }
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $pkg = dirname(__DIR__);

        // publish vendor resources
        if ($this->app->runningInConsole()) {
            $this->publishes([$pkg . '/config/handlers.php' => base_path('config/handlers.php')], 'config');
            $this->publishes([$pkg . '/stubs/handler.stub' => resource_path('stubs/handler.stub')], 'stubs');
        }
    }
}
