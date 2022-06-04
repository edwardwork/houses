<?php

use App\Http\Controllers\HouseController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/house/{fiasCode}', [HouseController::class, 'show']);
