<?php

namespace App\Managers;

use App\Models\Building;
use App\Models\City;
use App\Models\Save;
use App\Services\BuildingManager\UpdateSave;
use Illuminate\Support\Collection;

class BuildingManager
{
    public function create(
        Save $save, City $city, iterable $tiles, string $name, string $type, int $floor, array $jobs = [], array $upkeep = [], array $production = [],
        ?int $housing = null, array $cost = [], array $housing_repartition = [],
    ): Building
    {
        $tiles_collection = new Collection($tiles);

        $coordinates = $tiles_collection->map(function ($tile) {
            return [ 'x' => $tile->coord_x, 'y' => $tile->coord_y ];
        });

        $building = new Building();
        $building->save_id = $save->id;
        $building->city_id = $city->id;
        $building->tiles = $tiles_collection->pluck('id')->toArray();
        $building->name = $name;
        $building->type = $type;
        $building->floor = $floor;

        $building->jobs = (new Collection($jobs))->mapWithKeys(function ($amount, $job) use ($coordinates) {
            return [ $job => $amount * count($coordinates) ];
        })->toArray();

        $building->upkeep = (new Collection($upkeep))->mapWithKeys(function ($amount, $resource) use ($coordinates) {
            return [ $resource => $amount * count($coordinates) ];
        })->toArray();

        $building->production = (new Collection($production))->mapWithKeys(function ($amount, $resource) use ($coordinates) {
            return [ $resource => $amount * count($coordinates) ];
        })->toArray();

        $building->cost = $cost;
        $building->housing = $housing * count($coordinates);
        $building->coordinates = $coordinates->toArray();
        $building->housing_repartition = $housing_repartition;
        $building->save();

        app(UpdateSave::class)->handle($save, $building);

        return $building;
    }
}