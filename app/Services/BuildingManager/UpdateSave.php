<?php

namespace App\Services\BuildingManager;

use App\Models\Building;
use App\Models\Save;

class UpdateSave
{
    public function handle(Save $save, Building $building): void
    {
        $save_production = $save->production ?? [];

        foreach ($building->production as $production => $amount) {
            if (!isset($save_production[ $production ])) {
                $save_production[ $production ] = 0;
            }

            $save_production[ $production ] += $amount;
        }

        $save->production = $save_production;
        $save->save();
    }
}