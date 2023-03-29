<?php

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

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/want', \App\Http\Controllers\Api\GetWantController::class);
    Route::get('/done', \App\Http\Controllers\Api\GetDoneController::class);
    Route::post('/postContent', \App\Http\Controllers\Api\PostContentController::class);
    Route::get('/search', \App\Http\Controllers\Api\SearchImageController::class);
    Route::get('/edit', \App\Http\Controllers\Api\EditController::class);
});
