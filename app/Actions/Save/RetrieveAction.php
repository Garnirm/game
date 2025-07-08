<?php

namespace App\Actions\Save;

use App\Models\Player;
use App\Models\Save;
use App\Models\Tile;

class RetrieveAction
{
    public function execute(array $params): array
    {
        $save = Save::find($params['save_id']);

        if (!$save) {
            abort(404);
        }

        $position_view_tile = Tile::find($save->position_view_tile_id);

        if (!$position_view_tile) {
            abort(404);
        }

        $player = Player::where('save_id', $save->id)->where('is_ai', false)->first();

        $production_balance = $player->production;

        foreach ($player->upkeep as $resource => $amount) {
            if (!isset($production_balance[ $resource ])) {
                $production_balance[ $resource ] = 0;
            }

            $production_balance[ $resource ] -= $amount;
        }

        return [
            'success' => true,
            'data' => [
                'save_name' => $save->save_name,
                'tour' => $save->tour,
                'resources' => $player->resources,
                'position_view_tile' => $position_view_tile,
                'nb_unlockable_tiles' => $player->nb_unlockable_tiles,
                'upkeep' => $player->upkeep,
                'production' => $save->production,
                'production_balance' => $production_balance,
            ],
        ];
    }
}