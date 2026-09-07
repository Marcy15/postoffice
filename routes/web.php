<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountyController;
use App\Http\Controllers\PopulationController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/counties');

Route::resource('counties', CountyController::class)->except('show');
Route::resource('cities', CityController::class)->except('show');
Route::post('population/generate', [PopulationController::class, 'generate'])->name('population.generate');
Route::resource('population', PopulationController::class)->except('show');
