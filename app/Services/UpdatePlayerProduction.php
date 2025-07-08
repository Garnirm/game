<?php

namespace App\Services;

use App\Models\Building;
use App\Models\Job;
use App\Models\Player;

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

        $player->production = $production;
        $player->save();
    }
}