<?php

namespace Tests\Integration;

use Illuminate\Filesystem\Filesystem;
use Laravel\Handlers\Handler;
use Tests\TestCase;

/**
 * Class ServiceProviderTest
 *
 * @package     Tests\Integration
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class ServiceProviderTest extends TestCase
{
    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Test file handlers.php is existed in config directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Handlers\\ServiceProvider" --tag=laravel-handlers-config
     */
    public function testItShouldPublishVendorConfig()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/config/handlers.php';
        $targetFile = base_path('config/handlers.php');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Handlers\\ServiceProvider',
            '--tag' => 'laravel-handlers-config',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals($this->files->get($sourceFile), $this->files->get($targetFile));
    }

    /**
     * Test file handler.stubs is existed in resources/stubs directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Handlers\\ServiceProvider" --tag=laravel-handlers-stubs
     */
    public function testItShouldPublishVendorStubs()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/resources/stubs/handler.stub';
        $targetFile = resource_path('stubs/handler.stub');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Handlers\\ServiceProvider',
            '--tag' => 'laravel-handlers-stubs',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals($this->files->get($sourceFile), $this->files->get($targetFile));
    }

    /**
     * Test default config values
     */
    public function testItShouldProvideDefaultConfig()
    {
        $this->assertEquals(config('handlers.base'), Handler::class);
        $this->assertEquals(config('handlers.namespace'), '\\App\\Http\\Handlers');
    }

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->files = new Filesystem();
    }

    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
    protected function tearDown(): void
    {
        $this->files->delete([
            base_path('config/handlers.php'),
            resource_path('stubs/handler.stub'),
        ]);

        $this->files->cleanDirectory($this->app->path());

        parent::tearDown();
    }
}
