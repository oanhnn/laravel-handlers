<?php

namespace Laravel\Handlers;

use Illuminate\Support\ServiceProvider;

class HandlersServiceProvider extends ServiceProvider
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
        // register routes
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
            $this->publishes([$pkg . '/config/handlers.php' => config_path('handlers.php')], 'config');
            $this->publishes([$pkg . '/config/routes.php' => base_path('routes/handlers.php')], 'routes');
            $this->publishes([$pkg . '/stubs/handler.stub' => resource_path('stubs/handler.stub')], 'stubs');
        }
    }
}
