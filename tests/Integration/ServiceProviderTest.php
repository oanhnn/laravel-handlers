<?php

namespace Laravel\Handlers\Tests\Integration;

use Laravel\Handlers\Handler;
use Laravel\Handlers\Tests\TestCase;

/**
 * Class ServiceProviderTest
 *
 * @package     Laravel\Handlers\Tests\Integration
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class ServiceProviderTest extends TestCase
{
    /**
     * Test file handlers.php is existed in config directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Handlers\\ServiceProvider" --tag=config
     */
    public function testPublishVendorConfig()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/config/handlers.php';
        $targetFile = base_path('config/handlers.php');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Handlers\\ServiceProvider',
            '--tag' => 'config',
        ]);

        $this->assertFileExists($targetFile);
        $this->assertEquals(file_get_contents($sourceFile), file_get_contents($targetFile));
    }

    /**
     * Test file handler.stubs is existed in resources/stubs directory after run
     *
     * php artisan vendor:publish --provider="Laravel\\Handlers\\ServiceProvider" --tag=stubs
     */
    public function testPublishVendorStubs()
    {
        $sourceFile = dirname(dirname(__DIR__)) . '/stubs/handler.stub';
        $targetFile = resource_path('stubs/handler.stub');

        $this->assertFileNotExists($targetFile);

        $this->artisan('vendor:publish', [
            '--provider' => 'Laravel\\Handlers\\ServiceProvider',
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
}
