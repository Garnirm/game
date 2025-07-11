<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\AnimalManager
 */
class Animal extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'animal.manager';
    }
}