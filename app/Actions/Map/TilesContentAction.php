<?php

namespace App\Actions\Map;

use App\Models\Building;
use App\Models\Save;
use App\Models\Tile;
use Illuminate\Support\Collection;

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

        $coordinates_buildings = new Collection();

        Building::query()
            ->where('save_id', $save->id)
            ->where('coordinates', 'elemMatch', [
                'x' => [ '$gte' => $x_start, '$lte' => $x_max ],
                'y' => [ '$gte' => $y_start, '$lte' => $y_max ],
            ])
            ->toBase()
            ->get()
            ->each(function ($building) use ($coordinates_buildings, $x_max, $x_start, $y_max, $y_start) {
                $building->id = (string) $building->id;

                $size_coordinates = count($building->coordinates);

                if ($size_coordinates === 1) {
                    $building->display_label_coord = $building->coordinates[0];
                    $building->dimensions_box_label = [ 'width' => 80, 'height' => 80 ];
                } else {
                    $coordinates = (new Collection($building->coordinates))
                        ->filter(function ($coordinate) use ($x_max, $x_start, $y_max, $y_start) {
                            return $coordinate['x'] >= $x_start &&
                                $coordinate['x'] <= $x_max &&
                                $coordinate['y'] >= $y_start &&
                                $coordinate['y'] <= $y_max;
                        })
                        ->values();

                    $all_x = $coordinates->pluck('x')->unique()->values();
                    $all_y = $coordinates->pluck('y')->unique()->values();

                    $max_x = $all_x->max();
                    $min_x = $all_x->min();

                    $max_y = $all_y->max();
                    $min_y = $all_y->min();

                    $x_tiles_box = ($max_x - $min_x) + 1;
                    $y_tiles_box = ($max_y - $min_y) + 1;

                    $box_width = $x_tiles_box * 80;
                    $box_height = $y_tiles_box * 80;
                }

                foreach ($building->coordinates as $coordinates) {
                    $coordinates_buildings->put($coordinates['x'].'/'.$coordinates['y'], $building);
                }
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
            ->mapWithKeys(function ($tile) use ($coordinates_buildings) {
                $key = $tile->coord_x.'/'.$tile->coord_y;

                $tile->building = $coordinates_buildings->get($key);

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
                'buildings' => $coordinates_buildings,
                'tiles' => $map_tiles,
            ],
        ];
    }
}