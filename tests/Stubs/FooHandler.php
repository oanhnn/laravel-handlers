<?php

namespace Tests\Stubs;

use Illuminate\Http\Request;
use Laravel\Handlers\Handler;

/**
 * Class HandlerTest
 *
 * @package     Tests\Stubs
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
class FooHandler extends Handler
{
    /**
     * Handler processing
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return response('ok', 200);
    }

    /**
     * Handler processing
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return response('ok', 200);
    }
}
