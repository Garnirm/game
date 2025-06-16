<?php

namespace App\Services\BuildingManager;

use App\Models\Building;
use App\Models\Save;

class UpdateSave
{
    public function handle(Save $save, Building $building): void
    {
        $save_production = $save->production ?? [];
        $save_upkeep = $save->upkeep ?? [];

        foreach ($building->production as $production => $amount) {
            if (!isset($save_production[ $production ])) {
                $save_production[ $production ] = 0;
            }

            $save_production[ $production ] += $amount;
        }

        foreach ($building->upkeep as $upkeep => $amount) {
            if (!isset($save_upkeep[ $upkeep ])) {
                $save_upkeep[ $upkeep ] = 0;
            }

            $save_upkeep[ $upkeep ] += $amount;
        }

        $save->production = $save_production;
        $save->upkeep = $save_upkeep = $save_upkeep;
        $save->save();
    }
}