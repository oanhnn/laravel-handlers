<?php

namespace Laravel\Handlers\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Config;

/**
 * Class MakeHandler
 *
 * @package     Laravel\Handlers\Commands
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class MakeHandler extends GeneratorCommand
{
    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Handler';

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:handler {name} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handler class generator';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $customStub = resource_path('stubs/handler.stub');
        if ($this->files->exists($customStub)) {
            return $customStub;
        }

        return dirname(dirname(__DIR__)) . '/stubs/handler.stub';
    }

    /**
     * Get the default namespace for the class.
     *
     * @param  string $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return trim(Config::get('handlers.namespace', $rootNamespace . '\\Http\\Handlers'), '\\');
    }

    /**
     * Replace the namespace for the given stub.
     *
     * @param  string $stub
     * @param  string $name
     * @return $this
     */
    protected function replaceNamespace(&$stub, $name)
    {
        $rootNamespace = $this->rootNamespace();

        $stub = str_replace(
            ['DummyNamespace', 'DummyRootNamespace', 'DummyBaseHandlerNamespace'],
            [$this->getNamespace($name), $rootNamespace, trim(Config::get('handlers.base'), '\\')],
            $stub
        );

        return $this;
    }
}
