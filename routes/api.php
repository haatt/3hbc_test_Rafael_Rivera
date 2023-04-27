<?php

use App\Http\Controllers\AirlineController;
use App\Http\Controllers\AirportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FlightController;
use App\Http\Middleware\AuthenticateApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware([AuthenticateApi::class])->group(function() {
    // Route::get('/user', function (Request $request) {
    //     return $request->user();
    // });

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::resource('airports', AirportController::class)
        ->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('airlines', AirlineController::class)
        ->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('flights', FlightController::class)
        ->only(['index', 'store', 'show', 'edit', 'update', 'destroy']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
