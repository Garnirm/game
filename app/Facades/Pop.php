<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\PopManager
 */
class Pop extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'pop.manager';
    }
}