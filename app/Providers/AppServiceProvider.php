<?php

namespace App\Providers;

use App\Managers\AnimalManager;
use App\Managers\BuildingManager;
use App\Managers\PopManager;
use App\Managers\TileManager;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('animal.manager', fn () => new AnimalManager());
        $this->app->singleton('building.manager', fn () => new BuildingManager());
        $this->app->singleton('pop.manager', fn () => new PopManager());
        $this->app->singleton('tile.manager', fn () => new TileManager());
    }

    public function boot(): void
    {
        if (config('app.env') === 'prod') {
            URL::forceScheme('https');
        }

        View::composer('layout', function ($view) {
            $view->with(
                'housing_consumption',
                (new Collection(config('game_design.codex.population_classes')))
                    ->mapWithKeys(function ($data_class, $class) {
                        return [ $class => $data_class['housing_consumption'] ];
                    })
                    ->toJson(),
            );
        });
    }
}
