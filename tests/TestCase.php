<?php

namespace Laravel\Handlers\Tests;

use Illuminate\Filesystem\Filesystem;
use Laravel\Handlers\HandlersServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     *
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $this->files = new Filesystem();
    }

    /**
     * clean up after test
     */
    protected function tearDown()
    {
        $this->files->cleanDirectory($this->app->path());
        parent::tearDown();
    }

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
