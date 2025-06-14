<?php

namespace App\Managers;

use App\Models\City;
use App\Models\Save;
use App\Models\Tile;

class TileManager
{
    public function create(Save $save, ?City $city = null, int $coord_x, int $coord_y, ?string $type = null, string $biome): Tile
    {
        $tile = new Tile();
        $tile->save_id = $save->id;
        $tile->city_id = (!empty($city)) ? $city->id : null;
        $tile->coord_x = $coord_x;
        $tile->coord_y = $coord_y;
        $tile->type = $type ?? null;
        $tile->biome = $biome;
        $tile->save();

        return $tile;
    }
}