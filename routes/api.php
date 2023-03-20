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

Route::middleware('auth:sanctum')->get('/want', function (Request $request) {
    $user_id = $request->user()->id;
    return WantMovie::where('user_id', $user_id)->where('is_done', 0)->orderBy('updated_at', 'desc')->get();
});

Route::middleware('auth:sanctum')->get('/done', function (Request $request) {
    $user_id = $request->user()->id;
    return WantMovie::where('user_id', $user_id)->where('is_done', 1)->orderBy('updated_at', 'desc')->get();
});

Route::middleware('auth:sanctum')->get('/edit', function (Request $request) {
    $user_id = $request->user()->id;
    $id = $request->id;
    return WantMovie::where('user_id', $user_id)->where('id', $id)->get();
});
