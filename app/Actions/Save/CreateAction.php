<?php

namespace App\Actions\Save;

use App\Facades\Building as BuildingFacade;
use App\Facades\Tile as TileFacade;
use App\Models\City;
use App\Models\Save;
use App\Models\Tile;

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
        $save->nb_unlockable_tiles = config('game_design.unlockable_tiles.'.$save->territory_growth);

        $save->resources = [
            'money' => config('game_design.start_resources.money.'.$save->difficulty),
            'influence' => 10,
            'wood' => config('game_design.start_resources.wood.'.$save->difficulty)
        ];

        $save->save();

        $city = new City();
        $city->save_id = $save->id;
        $city->name = $params['first_city_name'];
        $city->save();

        $tile_0_0 = TileFacade::create(save: $save, city: $city, coord_x: 0, coord_y: 0, type: 'building', biome: 'plains');
        $tile_neg1_0 = TileFacade::create(save: $save, city: $city, coord_x: -1, coord_y: 0, type: 'building', biome: 'plains');

        $save->position_view_tile_id = $tile_0_0->id;
        $save->save();

        BuildingFacade::create(
            save: $save, city: $city, tile: $tile_0_0, name: 'Hôtel de ville', type: 'city_hall',
            floor: config('game_design.buildings.city_hall.base_floor'),
            jobs: config('game_design.buildings.city_hall.base_jobs'),
            upkeep: config('game_design.buildings.city_hall.base_upkeep'),
            production: config('game_design.buildings.city_hall.base_production'),
        );

        BuildingFacade::create(
            save: $save, city: $city, tile: $tile_neg1_0, name: 'Route', type: 'vertical_road',
            floor: config('game_design.buildings.vertical_road.base_floor'),
            jobs: config('game_design.buildings.vertical_road.base_jobs'),
            upkeep: config('game_design.buildings.vertical_road.base_upkeep'),
            production: config('game_design.buildings.vertical_road.base_production'),
        );

        return [
            'success' => true,
            'data' => $save->id,
        ];
    }
}