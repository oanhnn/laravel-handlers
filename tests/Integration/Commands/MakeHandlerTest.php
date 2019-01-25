<?php

namespace Laravel\Handlers\Tests\Integration\Commands;

use Laravel\Handlers\Tests\TestCase;
use RuntimeException;

/**
 * Class MakeHandlerTest
 *
 * @package     Laravel\Handlers\Tests\Integration\Commands
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class MakeHandlerTest extends TestCase
{
    /**
     * Test with name is specified, handler class will be generated successful
     */
    public function testNameIsSpecified()
    {
        $filePath = $this->app->path('Http/Handlers/ShowProfile.php');

        $this->assertFileNotExists($filePath);

        $this->artisan('make:handler', [
            'name' => 'ShowProfile',
        ]);

        $this->assertFileExists($filePath);
        // TODO: assert output
    }

    /**
     * Test with name isn't specified, exception will be throw
     */
    public function testNameIsNotSpecified()
    {
        $filePath = $this->app->path('Http/Handlers/ShowProfile.php');

        $this->assertFileNotExists($filePath);
        $this->expectException(RuntimeException::class);

        $this->artisan('make:handler');
    }

    /**
     * Test create an existed handler class with force option, handler class file will be re-generated
     */
    public function testCreateExistedHandlerClassWithForceOption()
    {
        $filePath = $this->app->path('Http/Handlers/ShowProfile.php');
        $initialHandlerContent = str_random(16);

        $this->forceFilePutContents($filePath, $initialHandlerContent);

        $this->assertEquals($initialHandlerContent, $this->files->get($filePath));

        $this->artisan('make:handler', [
            'name' => 'ShowProfile',
            '--force' => true,
        ]);

        $this->assertNotEquals($initialHandlerContent, file_get_contents($filePath));
    }

    /**
     * Test create an existed handler class without force option, handler class file wont re-generated
     */
    public function testCreateExistedHandlerClassWithoutForceOption()
    {
        $filePath = $this->app->path('Http/Handlers/ShowProfile.php');
        $initialHandlerContent = str_random(16);

        $this->forceFilePutContents($filePath, $initialHandlerContent);

        $this->assertEquals($initialHandlerContent, $this->files->get($filePath));

        $this->artisan('make:handler', [
            'name' => 'ShowProfile',
        ]);

        $this->assertEquals($initialHandlerContent, file_get_contents($filePath));
        // TODO: assert output
    }

    /**
     * Test create handler class with custom stub file
     */
    public function testUsingCustomStubFile()
    {
        $stubPath = resource_path('stubs/handler.stub');
        $stubContent = str_random(16);

        $this->forceFilePutContents($stubPath, $stubContent);

        $filePath = $this->app->path('Http/Handlers/ShowProfile.php');

        $this->assertFileNotExists($filePath);

        $this->artisan('make:handler', [
            'name' => 'ShowProfile',
        ]);

        $this->assertFileExists($filePath);
        $this->assertEquals($stubContent, file_get_contents($filePath));
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
