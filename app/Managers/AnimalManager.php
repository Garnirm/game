<?php

namespace App\Managers;

use App\Models\Animal;
use App\Models\Building;
use App\Models\Player;
use App\Models\Save;

class AnimalManager
{
    public function create(
        Save $save, Player $player, string $type, int $amount, Building $building, array $upkeep = [], array $production = [],
        array $cost = [],
    ): Animal
    {
        $animal = new Animal();
        $animal->save_id = $save->id;
        $animal->player_id = $player->id;
        $animal->building_id = $building->id;
        $animal->type = $type;
        $animal->amount = $amount;
        $animal->upkeep = $upkeep;
        $animal->production = $production;
        $animal->cost = $cost;
        $animal->save();

        return $animal;
    }
}