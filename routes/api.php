<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\WantMovie;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/want', \App\Http\Controllers\Api\GetWantController::class);

Route::middleware('auth:sanctum')->get('/done', \App\Http\Controllers\Api\GetDoneController::class);

Route::middleware('auth:sanctum')->post('/postContent', \App\Http\Controllers\Api\PostContentController::class);


Route::middleware('auth:sanctum')->get('/edit', function (Request $request) {
    $user_id = $request->user()->id;
    $id = $request->id;
    $movie = WantMovie::where('user_id', $user_id)->where('id', $id)->first();
    $movie->poster_path = str_replace("342", "154", $movie->poster_path);
    return $movie;
});
