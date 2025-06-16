<?php

namespace App\Console\Commands;

use App\Actions\Save\CreateAction;
use App\Models\Building;
use App\Models\City;
use App\Models\Job;
use App\Models\Pop;
use App\Models\Save;
use App\Models\Tile;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class FreshSave extends Command
{
    protected $signature = 'fresh:save';

    public function handle(): int
    {
        $save = Save::query()->first();

        if (!is_null($save)) {
            Building::where('save_id', $save->id)->forceDelete();
            City::where('save_id', $save->id)->forceDelete();
            Job::where('save_id', $save->id)->forceDelete();
            Pop::where('save_id', $save->id)->forceDelete();
            Tile::where('save_id', $save->id)->forceDelete();
            Save::where('id', $save->id)->forceDelete();
        }

        $action = app(CreateAction::class)->execute([
            'people_name' => 'Drarek', 'save_name' => 'Drarekstanie', 'difficulty' => 'normal', 'territory_growth' => 'normal',
            'wealth_resources' => 'normal', 'ia_density' => 'normal', 'initial_proximity' => 'normal', 'map_seed' => null,
            'first_city_name' => 'Faligadrie', 'player_trait_points' => 5, 'ia_trait_points' => 5,
        ]);

        $this->info('Save ID : '.$action['data']);

        $game_js = File::get(resource_path().'/js/store/game.js');

        preg_match('/var save_id = \'(.*)\'/', $game_js, $match_save_id);

        $game_js = str_replace($match_save_id[0], 'var save_id = \''.$action['data'].'\'', $game_js);

        File::put(resource_path().'/js/store/game.js', $game_js);

        return Command::SUCCESS;
    }
}
