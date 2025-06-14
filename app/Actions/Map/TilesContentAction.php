<?php

namespace App\Actions\Map;

use App\Models\Building;
use App\Models\Save;
use App\Models\Tile;

class TilesContentAction
{
    public function execute(array $params): array
    {
        $save = Save::find($params['save_id']);

        if (!$save) {
            abort(404);
        }

        $x_max = $params['x_max'];
        $x_start = $params['x_start'];

        $y_max = $params['y_max'];
        $y_start = $params['y_start'];

        $buildings = Building::query()
            ->where('save_id', $save->id)
            ->where('coord_x', '>=', $x_start)
            ->where('coord_x', '<=', $x_max)
            ->where('coord_y', '>=', $y_start)
            ->where('coord_y', '<=', $y_max)
            ->toBase()
            ->get()
            ->mapWithKeys(function ($building) {
                $key = $building->coord_x.'/'.$building->coord_y;

                return [ $key => $building ];
            });

        $tile_query_x_max = $x_max + 1;
        $tile_query_x_start = $x_start - 1;
        $tile_query_y_max = $y_max + 1;
        $tile_query_y_start = $y_start - 1;

        $tiles = Tile::query()
            ->where('save_id', $save->id)
            ->where('coord_x', '>=', $tile_query_x_start)
            ->where('coord_x', '<=', $tile_query_x_max)
            ->where('coord_y', '>=', $tile_query_y_start)
            ->where('coord_y', '<=', $tile_query_y_max)
            ->toBase()
            ->get()
            ->mapWithKeys(function ($tile) use ($buildings) {
                $key = $tile->coord_x.'/'.$tile->coord_y;

                $tile->building = $buildings->get($key);

                return [ $key => $tile ];
            });

        $map_tiles = [];

        for ($x = $x_start; $x <= $x_max; $x++) {
            for ($y = $y_start; $y <= $y_max; $y++) {
                $key = $x.'/'.$y;

                if ($tiles->has($key)) {
                    $map_tiles[ $key ] = $tiles->get($key);

                    continue;
                }

                $unlockable_tile = $tiles->has(($x + 1).'/'.$y) || $tiles->has(($x - 1).'/'.$y)
                    || $tiles->has($x.'/'.($y + 1)) || $tiles->has($x.'/'.($y - 1));

                if ($unlockable_tile) {
                    $map_tiles[ $key ] = [ 'coord_x' => (string) $x, 'coord_y' => (string) $y, 'unlockable' => true ];
                } else {
                    $map_tiles[ $key ] = [ 'coord_x' => (string) $x, 'coord_y' => (string) $y, 'unlockable' => false ];
                }
            }
        }

        return [
            'success' => true,
            'data' => [
                'tiles' => $map_tiles,
            ],
        ];
    }
}