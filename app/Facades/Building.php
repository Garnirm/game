<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\BuildingManager
 */
class Building extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'building.manager';
    }
}