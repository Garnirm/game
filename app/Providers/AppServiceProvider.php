<?php

namespace App\Providers;

use App\Managers\BuildingManager;
use App\Managers\PopManager;
use App\Managers\TileManager;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('building.manager', fn () => new BuildingManager());
        $this->app->singleton('pop.manager', fn () => new PopManager());
        $this->app->singleton('tile.manager', fn () => new TileManager());
    }

    public function boot(): void
    {
        if (config('app.env') === 'prod') {
            URL::forceScheme('https');
        }
    }
}
