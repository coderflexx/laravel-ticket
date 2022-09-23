<?php

namespace Coderflex\LaravelTicket\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Coderflex\LaravelTicket\LaravelTicket
 */
class LaravelTicket extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Coderflex\LaravelTicket\LaravelTicket::class;
    }
}
