<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PopulationController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/countries');

Route::resource('countries', CountryController::class)->except('show');
Route::resource('cities', CityController::class)->except('show');
Route::post('population/generate', [PopulationController::class, 'generate'])->name('population.generate');
Route::resource('population', PopulationController::class)->except('show');
