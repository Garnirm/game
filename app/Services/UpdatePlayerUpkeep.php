<?php

namespace App\Services;

use App\Models\Building;
use App\Models\Player;
use App\Models\Pop;

class UpdatePlayerUpkeep
{
    public function handle(Player $player): void
    {
        $upkeep = [];

        $pops = Pop::where('player_id', $player->id)->select('class', 'amount')->get();

        foreach ($pops as $pop) {
            $consumption = config('game_design.codex.population_classes.'.$pop->class.'.upkeep');

            foreach ($consumption as $resource => $resource_amount) {
                if (!isset($upkeep[ $resource ])) {
                    $upkeep[ $resource ] = 0;
                }

                $upkeep[ $resource ] += $resource_amount * $pop->amount;
            }
        }

        $buildings = Building::where('player_id', $player->id)->select('upkeep')->get();

        foreach ($buildings as $building) {
            foreach ($building->upkeep as $resource => $resource_amount) {
                if (!isset($upkeep[ $resource ])) {
                    $upkeep[ $resource ] = 0;
                }

                $upkeep[ $resource ] += $resource_amount;
            }
        }

        $player->upkeep = $upkeep;
        $player->save();
    }
}