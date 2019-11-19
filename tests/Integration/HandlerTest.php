<?php

namespace Tests\Integration;

use BadMethodCallException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Tests\Stubs\FooHandler;
use Tests\TestCase;

/**
 * Class HandlerTest
 *
 * @package     Tests\Integration
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class HandlerTest extends TestCase
{
    /**
     * Test it should call __invoke method of handler class
     */
    public function testItShouldCallInvokeMethod()
    {
        $response = $this->get('/ok');
        $response->assertStatus(200);
        $response->assertSeeText('ok');
    }

    /**
     * Test it shouldn't call other action (not __invoke method)
     *
     * @return void
     */
    public function testItShouldNotCallIndexMethod()
    {
        $response = $this->get('/err');
        $response->assertStatus(500);
    }

    /**
     * Test it should allow only one action (__invoke method)
     *
     * @return void
     */
    public function testItShouldAllowCallOnlyOneAction()
    {
        $handler = new FooHandler();
        $request = $this->app->make(Request::class);

        $handler->callAction('__invoke', [$request]);

        $this->expectException(BadMethodCallException::class);
        $this->expectExceptionMessage('Only __invoke method can be called on handler.');

        $handler->callAction('foo', [$request]);
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application   $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        Route::get('/ok', FooHandler::class);
        Route::get('/err', FooHandler::class . '@index');
    }
}
