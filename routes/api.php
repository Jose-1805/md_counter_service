<?php

use App\Http\Controllers\CounterController;
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
Route::prefix('counter')->group(function () {
    Route::put("increment", [CounterController::class, "increment"]);
    Route::put("decrement", [CounterController::class, "decrement"]);
});

Route::apiResource('counter', CounterController::class);
