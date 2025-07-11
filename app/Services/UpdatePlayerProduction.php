<?php

namespace App\Services;

use App\Models\Animal;
use App\Models\Building;
use App\Models\Job;
use App\Models\Player;
use Illuminate\Support\Collection;

class UpdatePlayerProduction
{
    public function handle(Player $player): void
    {
        $production = [];

        $jobs = Job::where('player_id', $player->id)->select('production', 'taken')->get()->toArray();

        foreach ($jobs as $job) {
            if (!empty($job['production'])) {
                foreach ($job['production'] as $resource => $resource_amount) {
                    if (!isset($production[ $resource ])) {
                        $production[ $resource ] = 0;
                    }

                    $production[ $resource ] += $resource_amount * $job['taken'];
                }
            }
        }

        $buildings = Building::where('player_id', $player->id)->select('production')->get();

        foreach ($buildings as $building) {
            foreach ($building->production as $resource => $resource_amount) {
                if (!isset($production[ $resource ])) {
                    $production[ $resource ] = 0;
                }

                $production[ $resource ] += $resource_amount;
            }
        }

        $animals = Animal::where('player_id', $player->id)->get();

        foreach ($animals as $animal) {
            if ($animal->type === 'cow') {
                $building_cow = Building::find($animal->building_id);

                $all_x = (new Collection($building_cow->coordinates))->pluck('x')->unique()->values();
                $all_y = (new Collection($building_cow->coordinates))->pluck('y')->unique()->values();

                $min_x = $all_x->min();
                $max_x = $all_x->max();

                $min_y = $all_y->min();
                $max_y = $all_y->max();

                $milk_factories = Building::query()
                    ->where('player_id', $player->id)
                    ->where('type', 'milk_factory')
                    ->where('coordinates', 'elemMatch', [
                        'x' => [ '$gte' => $min_x - 5, '$lte' => $max_x + 5 ],
                        'y' => [ '$gte' => $min_y - 5, '$lte' => $max_y + 5 ],
                    ])
                    ->get();

                if ($milk_factories->isEmpty()) {
                    continue;
                }

                $milk_workers = Job::whereIn('building_id', $milk_factories->pluck('id')->toArray())
                    ->where('type', 'milk_worker')
                    ->get()
                    ->sum('taken');

                foreach ($animal->production as $resource => $resource_amount) {
                    if (!isset($production[ $resource ])) {
                        $production[ $resource ] = 0;
                    }

                    $production[ $resource ] += $resource_amount * $milk_workers;
                }
            }
        }

        $player->production = $production;
        $player->save();
    }
}