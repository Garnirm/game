<?php

namespace App\Console\Commands;

use App\Actions\Save\CreateAction;
use App\Models\Building;
use App\Models\City;
use App\Models\Save;
use App\Models\Tile;
use Illuminate\Console\Command;

class FreshSave extends Command
{
    protected $signature = 'fresh:save';

    public function handle(): int
    {
        $save = Save::query()->first();

        if (!is_null($save)) {
            Building::where('save_id', $save->id)->forceDelete();
            Tile::where('save_id', $save->id)->forceDelete();
            City::where('save_id', $save->id)->forceDelete();
            Save::where('id', $save->id)->forceDelete();
        }

        $action = app(CreateAction::class)->execute([
            'people_name' => 'Drarek', 'save_name' => 'Drarekstanie', 'difficulty' => 'normal', 'territory_growth' => 'normal',
            'wealth_resources' => 'normal', 'ia_density' => 'normal', 'initial_proximity' => 'normal', 'map_seed' => null,
            'first_city_name' => 'Faligadrie', 'player_trait_points' => 5, 'ia_trait_points' => 5,
        ]);

        $this->info('Save ID : '.$action['data']);

        return Command::SUCCESS;
    }
}
