<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\SaveController;
use Illuminate\Support\Facades\Route;

Route::get('check', function () {
    return 'ok';
});

Route::view('', 'template');
Route::view('create', 'template');
Route::view('game', 'template');

Route::prefix('building')->group(function () {
    Route::post('details', [ BuildingController::class, 'details' ]);
    Route::post('update/housing_repartition', [ BuildingController::class, 'updateHousingRepartition' ]);
});

Route::prefix('map')->group(function () {
    Route::post('tiles_content', [ MapController::class, 'tilesContent' ]);
});

Route::post('save/create', [ SaveController::class, 'create' ]);
Route::post('save/retrieve', [ SaveController::class, 'retrieve' ]);

// Route::post('{billing_income}/details', [ IncomeController::class, 'details' ])->middleware([ CheckEntity::class ]);