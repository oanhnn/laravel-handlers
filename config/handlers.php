<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Handler Class Namespace
    |--------------------------------------------------------------------------
    |
    | Here you may specify which namespace will be used for all generated handlers.
    |
    */
    'namespace' => '\\App\\Http\\Handlers',

    /*
    |--------------------------------------------------------------------------
    | Base Handler Class
    |--------------------------------------------------------------------------
    |
    | Here you may specify which class will be used as the base class
    | for all generated handlers.
    |
    | Default is `\Laravel\Handlers\Handler::class` , but it only work with Laravel.
    | Alternative value is `\App\Http\Controllers\Controller::class` (work with both Laravel and Lumen)
    */
    'base' => \Laravel\Handlers\Handler::class,
];
