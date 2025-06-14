<?php

namespace App\Actions\Save;

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

        return [
            'success' => true,
            'data' => [
                'save_name' => $save->save_name,
                'tour' => $save->tour,
                'resources' => $save->resources,
                'position_view_tile' => $position_view_tile,
            ],
        ];
    }
}