<?php

use App\Http\Controllers\HouseController;
use Illuminate\Support\Facades\Route;

Route::get('/house/{fiasCode}', [HouseController::class, 'show']);
