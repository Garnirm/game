<?php

namespace App\Managers;

use App\Models\Building;
use App\Models\City;
use App\Models\Save;
use App\Models\Tile;
use App\Services\BuildingManager\UpdateSave;

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

        app(UpdateSave::class)->handle($save, $building);

        return $building;
    }

    public function linkBuildings(array $buildings): void
    {
        foreach ($buildings as $building) {
            $linked_to = [];

            foreach ($buildings as $iter_building) {
                if ($iter_building->id === $building->id) {
                    continue;
                }

                $linked_to[] = $iter_building->id;
            }

            $building->linked_to = $linked_to;
            $building->save();
        }
    }
}