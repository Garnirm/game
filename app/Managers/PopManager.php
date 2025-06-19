<?php

namespace App\Managers;

use App\Models\Building;
use App\Models\Job;
use App\Models\Player;
use App\Models\Pop;
use App\Models\Save;

class PopManager
{
    public function create(Save $save, Player $player, Building $building, string $class, int $amount, array $jobs = []): Pop
    {
        $pop = new Pop();
        $pop->save_id = $save->id;
        $pop->player_id = $player->id;
        $pop->building_id = $building->id;
        $pop->class = $class;
        $pop->amount = $amount;
        $pop->save();

        foreach ($jobs as $job) {
            [ $x, $y ] = explode('_', $job['building_coordinates']);

            $x = (int) $x;
            $y = (int) $y;

            $building = Building::query()->where('save_id', $save->id)
                ->where('coordinates', 'elemMatch', [
                    'x' => [ '$eq' => $x ],
                    'y' => [ '$eq' => $y ],
                ])
                ->first();

            $job = Job::query()
                ->where('save_id', $save->id)
                ->where('building_id', $building->id)
                ->where('type', $job['job'])
                ->first();

            $job->taken = $job->taken + $job['amount'];
            $job->save();
        }

        return $pop;
    }
}