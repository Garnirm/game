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
            ->each(function ($building) use ($coordinates_buildings) {
                $building->id = (string) $building->id;

                $size_coordinates = count($building->coordinates);

                if ($size_coordinates === 1) {
                    $building->display_label_coord = $building->coordinates[0];
                } else {
                    $more_large_width = [ 'y' => null, 'x_min' => 0, 'x_max' => 0, 'size' => 0 ];

                    $coordinates_y = (new Collection($building->coordinates))->groupBy('y');

                    foreach ($coordinates_y as $y => $coordinates) {
                        $max_x = null;
                        $min_x = null;

                        foreach ($coordinates as $c) {
                            if (is_null($min_x) || $c['x'] < $min_x) {
                                $min_x = $c['x'];
                            }

                            if (is_null($max_x) || $c['x'] > $max_x) {
                                $max_x = $c['x'];
                            }
                        }

                        if ($min_x > $max_x) {
                            $size_x = ($min_x - $max_x) + 1;
                        } else {
                            $size_x = ($max_x - $min_x) + 1;
                        }

                        if ($size_x > $more_large_width['size']) {
                            $more_large_width['y'] = $y;
                            $more_large_width['x_min'] = $min_x;
                            $more_large_width['x_max'] = $max_x;
                            $more_large_width['size'] = $size_x;
                        }

                        if ($more_large_width['size'] === 2) {
                            $building->display_label_coord = [ 'y' => $more_large_width['y'], 'x' => $more_large_width['x_min'] ];
                        } else {
                            $half_x = $more_large_width['size'] / 2;

                            if (strpos($half_x, '.') !== false) {
                                $half_x = (int) floor($half_x);
                            }

                            $building->display_label_coord = [ 'y' => $more_large_width['y'], 'x' => $more_large_width['x_min'] + $half_x ];
                        }
                    }
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