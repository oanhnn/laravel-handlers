<?php

namespace Laravel\Handlers\Tests\Unit\Commands;

use Illuminate\Filesystem\Filesystem;
use Laravel\Handlers\Commands\MakeHandler;
use Laravel\Handlers\Tests\NonPublicAccessibleTrait;
use Laravel\Handlers\Tests\TestCase;

/**
 * Class MakeHandlerTest
 *
 * @package     Laravel\Handlers\Tests\Unit\Commands
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class MakeHandlerTest extends TestCase
{
    use NonPublicAccessibleTrait;

    /**
     * @throws \ReflectionException
     */
    public function testUsingDefaultStubFile()
    {
        $stubPath = dirname(dirname(dirname(__DIR__))) . '/stubs/handler.stub';

        $command = new MakeHandler($this->app->make(Filesystem::class));

        $this->assertEquals($stubPath, $this->invokeNonPublicMethod($command, 'getStub'));
    }

    /**
     * Test using custom stub file
     *
     * @throws \ReflectionException
     */
    public function testUsingCustomStubFile()
    {
        $stubPath = resource_path('stubs/handler.stub');
        $stubContent = str_random(16);

        $this->forceFilePutContents($stubPath, $stubContent);
        $this->assertFileExists($stubPath);

        $command = new MakeHandler($this->app->make(Filesystem::class));

        $this->assertEquals($stubPath, $this->invokeNonPublicMethod($command, 'getStub'));
    }

    /**
     * Put contents to file.
     *
     * @param string $path
     * @param string $contents
     * @param bool $lock
     */
    protected function forceFilePutContents(string $path, string $contents, bool $lock = false): void
    {
        if (!$this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }

        $this->files->put($path, $contents, $lock);
    }
}
