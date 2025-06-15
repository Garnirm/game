<?php

namespace App\Actions\Save;

use App\Facades\Building as BuildingFacade;
use App\Facades\Tile as TileFacade;
use App\Models\City;
use App\Models\Save;

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
            'concrete' => config('game_design.start_resources.concrete.'.$save->difficulty),
            'food' => config('game_design.start_resources.food.'.$save->difficulty),
            'money' => config('game_design.start_resources.money.'.$save->difficulty),
            'steel' => config('game_design.start_resources.steel.'.$save->difficulty),
            'wood' => config('game_design.start_resources.wood.'.$save->difficulty),
            'influence' => 10,
        ];

        $save->save();

        $city = new City();
        $city->save_id = $save->id;
        $city->name = $params['first_city_name'];
        $city->save();

        // Variables marquées inutilisées mais utilisées par le $$variable dans le foreach $roads
        $tile_0_neg1 = TileFacade::create(save: $save, city: $city, coord_x: 0, coord_y: -1, type: 'building', biome: 'plains');
        $tile_0_0 = TileFacade::create(save: $save, city: $city, coord_x: 0, coord_y: 0, type: 'building', biome: 'plains');

        $tile_neg1_neg1 = TileFacade::create(save: $save, city: $city, coord_x: -1, coord_y: -1, type: 'building', biome: 'plains');
        $tile_neg1_0 = TileFacade::create(save: $save, city: $city, coord_x: -1, coord_y: 0, type: 'building', biome: 'plains');

        $tile_neg2_neg1 = TileFacade::create(save: $save, city: $city, coord_x: -2, coord_y: -1, type: 'building', biome: 'plains');
        $tile_neg2_0 = TileFacade::create(save: $save, city: $city, coord_x: -2, coord_y: 0, type: 'building', biome: 'plains');

        $tile_neg3_neg1 = TileFacade::create(save: $save, city: $city, coord_x: -3, coord_y: -1, type: 'building', biome: 'plains');
        $tile_neg3_0 = TileFacade::create(save: $save, city: $city, coord_x: -3, coord_y: 0, type: 'building', biome: 'plains');

        $save->position_view_tile_id = $tile_0_0->id;
        $save->save();

        $roads = config('game_design.start_roads');

        foreach ($roads as $road) {
            $variable = 'tile_';
            $variable .= ($road['x'] < 0) ? 'neg'.(-$road['x']) : $road['x'];
            $variable .= '_';
            $variable .= ($road['y'] < 0) ? 'neg'.(-$road['y']) : $road['y'];

            BuildingFacade::create(
                save: $save, city: $city, name: $road['name'], type: $road['type'],
                floor: config('game_design.buildings.'.$road['type'].'.base_floor'),
                jobs: config('game_design.buildings.'.$road['type'].'.base_jobs'),
                upkeep: config('game_design.buildings.'.$road['type'].'.base_upkeep'),
                production: config('game_design.buildings.'.$road['type'].'.base_production'),
                cost: config('game_design.buildings.'.$road['type'].'.base_cost'),
                tiles: [ $$variable ],
            );
        }

        BuildingFacade::create(
            save: $save, city: $city, name: 'Hôtel de ville', type: 'city_hall',
            floor: config('game_design.buildings.city_hall.base_floor'),
            jobs: config('game_design.buildings.city_hall.base_jobs'),
            upkeep: config('game_design.buildings.city_hall.base_upkeep'),
            production: config('game_design.buildings.city_hall.base_production'),
            cost: config('game_design.buildings.city_hall.base_cost'),
            tiles: [ $tile_0_0 ],
        );

        BuildingFacade::create(
            save: $save, city: $city, name: 'Immeuble', type: 'apartments',
            floor: config('game_design.buildings.apartments.base_floor'),
            jobs: config('game_design.buildings.apartments.base_jobs'),
            upkeep: config('game_design.buildings.apartments.base_upkeep'),
            production: config('game_design.buildings.apartments.base_production'),
            housing: config('game_design.buildings.apartments.base_housing'),
            cost: config('game_design.buildings.apartments.base_cost'),
            tiles: [ $tile_neg2_0, $tile_neg3_0 ],
        );

        return [
            'success' => true,
            'data' => $save->id,
        ];
    }
}