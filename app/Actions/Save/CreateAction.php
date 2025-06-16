<?php

namespace App\Actions\Save;

use App\Facades\Building as BuildingFacade;
use App\Facades\Pop as PopFacade;
use App\Facades\Tile as TileFacade;
use App\Models\Building;
use App\Models\City;
use App\Models\Save;
use App\Services\TransformNegative;
use Illuminate\Support\Collection;

class CreateAction
{
    public function execute(array $params): array
    {
        $save = new Save();
        $save->people_name = $params['people_name'];
        $save->save_name = $params['save_name'];
        $save->difficulty = $params['difficulty'];
        $save->territory_growth = $params['territory_growth'];
        $save->wealth_resources = $params['wealth_resources'];
        $save->ia_density = $params['ia_density'];
        $save->initial_proximity = $params['initial_proximity'];
        $save->map_seed = $params['map_seed'] ?? null;
        $save->player_trait_points = $params['player_trait_points'];
        $save->ia_trait_points = $params['ia_trait_points'];
        $save->tour = 1;
        $save->nb_unlockable_tiles = config('game_design.codex.unlockable_tiles.'.$save->territory_growth);
        $save->resources = (new Collection(config('game_design.start.resources')))->map(fn ($resource) => $resource[ $save->difficulty ])->toArray();
        $save->save();

        $city = new City();
        $city->save_id = $save->id;
        $city->name = $params['first_city_name'];
        $city->save();

        $tiles = [];

        $buildings = config('game_design.start.buildings');
        $pops = config('game_design.start.pops');
        $roads = config('game_design.start.roads');
        $start_tiles = config('game_design.start.tiles');

        foreach ($start_tiles as $tile) {
            $tiles[ $tile['name'] ] = TileFacade::create(save: $save, city: $city, coord_x: $tile['coord_x'], coord_y: $tile['coord_y'], type: $tile['type'], biome: $tile['biome']);
        }

        $save->position_view_tile_id = $tiles['0_0']->id;
        $save->save();

        foreach ($roads as $road) {
            $variable = ($road['x'] < 0) ? 'neg'.(-$road['x']) : $road['x'];
            $variable .= '_';
            $variable .= ($road['y'] < 0) ? 'neg'.(-$road['y']) : $road['y'];

            BuildingFacade::create(
                save: $save, city: $city, name: $road['name'], type: $road['type'],
                floor: config('game_design.buildings.'.$road['type'].'.base_floor'),
                jobs: config('game_design.buildings.'.$road['type'].'.base_jobs'),
                upkeep: config('game_design.buildings.'.$road['type'].'.base_upkeep'),
                production: config('game_design.buildings.'.$road['type'].'.base_production'),
                cost: config('game_design.buildings.'.$road['type'].'.base_cost'),
                tiles: [ $tiles[ $variable ] ],
            );
        }

        foreach ($buildings as $building) {
            BuildingFacade::create(
                save: $save, city: $city, name: $building['name'], type: $building['type'],
                floor: config('game_design.buildings.'.$building['type'].'.base_floor'),
                jobs: config('game_design.buildings.'.$building['type'].'.base_jobs'),
                upkeep: config('game_design.buildings.'.$building['type'].'.base_upkeep'),
                production: config('game_design.buildings.'.$building['type'].'.base_production'),
                housing: config('game_design.buildings.'.$building['type'].'.base_housing'),
                cost: config('game_design.buildings.'.$building['type'].'.base_cost'),
                tiles: (new Collection($building['tiles']))->map(fn ($tile) => $tiles[ $tile ]),
            );
        }

        foreach ($pops as $coordinates => $pops_classes) {
            [ $x, $y ] = explode('_', $coordinates);

            $x = TransformNegative::castToRealNumber($x);
            $y = TransformNegative::castToRealNumber($y);

            $building = Building::query()->where('save_id', $save->id)
                ->where('coordinates', 'elemMatch', [
                    'x' => [ '$eq' => $x ],
                    'y' => [ '$eq' => $y ],
                ])
                ->first();

            foreach ($pops_classes as $class => $data_class) {
                PopFacade::create(save: $save, building: $building, class: $class, amount: $data_class['amount'], jobs: $data_class['jobs']);
            }
        }

        return [
            'success' => true,
            'data' => $save->id,
        ];
    }
}