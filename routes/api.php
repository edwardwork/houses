<?php

use App\Http\Controllers\HouseController;
use App\Http\Controllers\ResidentialComplexController;
use Illuminate\Support\Facades\Route;

Route::get('/house/{fiasCode}', [HouseController::class, 'show']);
Route::get('/residentialComplexes', [ResidentialComplexController::class, 'index']);
Route::get('/residentialComplexes/apartments', [ResidentialComplexController::class, 'indexWithApartments']);
Route::get('/residentialComplexes/residentialHouses', [ResidentialComplexController::class, 'indexWithResidentialHouses']);
