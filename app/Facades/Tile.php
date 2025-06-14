<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \App\Services\TileManager
 */
class Tile extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'tile.manager';
    }
}