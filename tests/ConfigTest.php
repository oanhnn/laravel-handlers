<?php

namespace Laravel\Handlers\Tests;

use Laravel\Handlers\Handler;

class ConfigTest extends TestCase
{
    /**
     * Test default config values
     */
    public function testDefaultConfigValues()
    {
        $this->assertEquals(config('handlers.base'), Handler::class);
        $this->assertEquals(config('handlers.namespace'), '\\App\\Http\\Handlers');
    }
}
