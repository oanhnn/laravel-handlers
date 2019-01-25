<?php

namespace Laravel\Handlers\Tests;

use Illuminate\Filesystem\Filesystem;
use Laravel\Handlers\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

/**
 * Class TestCase
 *
 * @package     Laravel\Handlers\Tests
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
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
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $this->files = new Filesystem();
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown()
    {
        $this->files->delete([
            base_path('config/handlers.php'),
            resource_path('stubs/handler.stub'),
        ]);

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
            ServiceProvider::class,
        ];
    }
}
