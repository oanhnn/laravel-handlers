<?php

namespace Laravel\Handlers\Tests;

use Laravel\Handlers\HandlersServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            HandlersServiceProvider::class,
        ];
    }
}
