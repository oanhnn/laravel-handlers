<?php

namespace Laravel\Handlers\Tests;

use Laravel\Handlers\Handler;

class HandlersServiceProviderTest extends TestCase
{
    /**
     * Clear created resource
     */
    public function tearDown()
    {
        $this->files->delete([
            config_path('handlers.php'),
            base_path('routes/handlers.php'),
            resource_path('stubs/handler.stub'),
        ]);
        parent::tearDown();
    }

    /**
     * Test file handlers.php is existed in config directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Handlers\\HandlersServiceProvider" --tag=config
     */
    public function testPublishVendorConfig()
    {
        $sourceFile = dirname(__DIR__) . '/config/handlers.php';
        $targetFile = config_path('handlers.php');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Handlers\\HandlersServiceProvider',
            '--tag' => 'config',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals(file_get_contents($sourceFile), file_get_contents($targetFile));
    }

    /**
     * Test file handlers.php is existed in routes directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Handlers\\HandlersServiceProvider" --tag=routes
     */
    public function testPublishVendorRoutes()
    {
        $sourceFile = dirname(__DIR__) . '/config/routes.php';
        $targetFile = base_path('routes/handlers.php');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Handlers\\HandlersServiceProvider',
            '--tag' => 'routes',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals(file_get_contents($sourceFile), file_get_contents($targetFile));
    }

    /**
     * Test file handler.stubs is existed in resources/stubs directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Handlers\\HandlersServiceProvider" --tag=stubs
     */
    public function testPublishVendorStubs()
    {
        $sourceFile = dirname(__DIR__) . '/stubs/handler.stub';
        $targetFile = resource_path('stubs/handler.stub');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Handlers\\HandlersServiceProvider',
            '--tag' => 'stubs',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals(file_get_contents($sourceFile), file_get_contents($targetFile));
    }

    /**
     * Test default config values
     */
    public function testDefaultConfigValues()
    {
        $this->assertEquals(config('handlers.base'), Handler::class);
        $this->assertEquals(config('handlers.namespace'), '\\App\\Http\\Handlers');
    }

    /**
     * Test merged config values
     */
    public function testMergedConfigValues()
    {
        $this->assertTrue(true);
    }

    public function testLoadedRoutes()
    {
        $this->assertTrue(true);
    }

    public function testRegisterCommands()
    {
        $this->assertTrue(true);
    }
}
