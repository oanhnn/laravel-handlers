<?php

namespace Laravel\Handlers;

use BadMethodCallException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;

/**
 * Class Handler
 *
 * @package     Laravel\Handlers
 * @author      Oanh Nguyen <oanhnn.bk@gmail.com>
 * @license     The MIT License
 */
abstract class Handler extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Execute an action on the handler.
     *
     * @param  string $method
     * @param  array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function callAction($method, $parameters)
    {
        if ($method === '__invoke') {
            return call_user_func_array([$this, $method], $parameters);
        }
        throw new BadMethodCallException('Only __invoke method can be called on handler.');
    }
}
