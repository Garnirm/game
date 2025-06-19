<?php

namespace App\Actions\Building;

use App\Models\Building;
use App\Models\Save;

class UpdateHousingRepartitionAction
{
    public function execute(array $params): array
    {
        $save = Save::find($params['save_id']);

        if (!$save) {
            abort(404);
        }

        $building = Building::query()->where('save_id', $save->id)->where('id', $params['building_id'])->first();

        if (!$building) {
            abort(404);
        }

        return [ 'success' => true ];
    }
}