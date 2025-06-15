<?php

namespace App\Managers;

use App\Models\Building;
use App\Models\City;
use App\Models\Save;
use App\Models\Tile;

class BuildingManager
{
    public function create(
        Save $save, City $city, Tile $tile, string $name, string $type, int $floor, array $jobs = [], array $upkeep = [], array $production = [],
        ?int $housing = null,
    ): Building
    {
        $building = new Building();
        $building->save_id = $save->id;
        $building->city_id = $city->id;
        $building->tile = $tile->id;
        $building->name = $name;
        $building->type = $type;
        $building->floor = $floor;
        $building->jobs = $jobs;
        $building->upkeep = $upkeep;
        $building->production = $production;
        $building->housing = $housing;
        $building->coord_x = $tile->coord_x;
        $building->coord_y = $tile->coord_y;
        $building->save();

        $save_jobs = $save->jobs ?? [];
        $save_production = $save->production ?? [];
        $save_upkeep = $save->upkeep ?? [];

        foreach ($building->jobs as $job => $amount) {
            if (!isset($save_jobs[ $job ])) {
                $save_jobs[ $job ] = 0;
            }

            $save_jobs[ $job ] += $amount;
        }

        foreach ($building->production as $production => $amount) {
            if (!isset($save_production[ $production ])) {
                $save_production[ $production ] = 0;
            }

            $save_production[ $production ] += $amount;
        }

        foreach ($building->upkeep as $upkeep => $amount) {
            if (!isset($save_upkeep[ $upkeep ])) {
                $save_upkeep[ $upkeep ] = 0;
            }

            $save_upkeep[ $upkeep ] += $amount;
        }

        $save->jobs = $save_jobs;
        $save->production = $save_production;
        $save->upkeep = $save_upkeep = $save_upkeep;
        $save->save();

        return $building;
    }
}