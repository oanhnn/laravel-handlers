<?php

namespace Tests\Integration\Commands;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use Laravel\Handlers\Commands\MakeHandler;
use Tests\TestCase;
use RuntimeException;
use Tests\Concerns\NonPublicAccessible;

/**
 * Class MakeHandlerTest
 *
 * @package     Tests\Integration\Commands
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class MakeHandlerTest extends TestCase
{
    use NonPublicAccessible;

    /**
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Test command should run success when handler name argument is specified
     *
     * @return void
     */
    public function testItShouldRunWhenNameIsSpecified()
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
     * Test command should throw an exception when handler name argument is not specified
     *
     * @return void
     */
    public function testItShouldThrowExceptionWhenNameIsNotSpecified()
    {
        $filePath = $this->app->path('Http/Handlers/ShowProfile.php');

        $this->assertFileNotExists($filePath);
        $this->expectException(RuntimeException::class);

        $this->artisan('make:handler');
    }

    /**
     * Test command should override existed handler class when it run with force option
     *
     * @return void
     */
    public function testItShouldOverrideHandlerClassWhenItRunWithForceOption()
    {
        $filePath = $this->app->path('Http/Handlers/ShowProfile.php');
        $initialHandlerContent = Str::random(16);

        $this->forceFilePutContents($filePath, $initialHandlerContent);

        $this->assertEquals($initialHandlerContent, $this->files->get($filePath));

        $this->artisan('make:handler', [
            'name' => 'ShowProfile',
            '--force' => true,
        ]);

        $this->assertNotEquals($initialHandlerContent, file_get_contents($filePath));
    }

    /**
     * Test command should not override existed handler class when it run without force option
     *
     * @return void
     */
    public function testItShouldNotOverrideHandlerClassWhenItRunWithoutForceOption()
    {
        $filePath = $this->app->path('Http/Handlers/ShowProfile.php');
        $initialHandlerContent = Str::random(16);

        $this->forceFilePutContents($filePath, $initialHandlerContent);

        $this->assertEquals($initialHandlerContent, $this->files->get($filePath));

        $this->artisan('make:handler', [
            'name' => 'ShowProfile',
        ]);

        $this->assertEquals($initialHandlerContent, file_get_contents($filePath));
        // TODO: assert output
    }

    /**
     * Test it should use default stub file
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testItShouldUseDefaultStubFile()
    {
        $stubPath = dirname(dirname(dirname(__DIR__))) . '/resources/stubs/handler.stub';

        $command = new MakeHandler($this->app->make(Filesystem::class));

        $this->assertEquals($stubPath, $this->invokeNonPublicMethod($command, 'getStub'));
    }

    /**
     * Test it should use custom stub file
     *
     * @return void
     * @throws \ReflectionException
     */
    public function testItShouldUseCustomStubFile()
    {
        $stubPath = resource_path('stubs/handler.stub');
        $stubContent = Str::random(16);

        $this->forceFilePutContents($stubPath, $stubContent);
        $this->assertFileExists($stubPath);

        $command = new MakeHandler($this->app->make(Filesystem::class));

        $this->assertEquals($stubPath, $this->invokeNonPublicMethod($command, 'getStub'));
    }

    /**
     * Test it should generate handler classn from custom stub file
     *
     * @return void
     */
    public function testItShouldGenerateFromCustomStubFile()
    {
        $stubPath = resource_path('stubs/handler.stub');
        $stubContent = Str::random(16);

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
