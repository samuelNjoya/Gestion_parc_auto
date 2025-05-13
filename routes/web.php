<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\backend\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/',[AuthController::class,'login']);
Route::get('logout',[AuthController::class, 'logout']);

//Dashboard
Route::get('panel/dashboard',[DashboardController::class, 'dashboard']);
