<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // want movie
    Route::get('/movies/bucket', \App\Http\Controllers\WantMovie\IndexController::class)
        ->name('want.movie.index');
    Route::get('/movies/bucket/add', \App\Http\Controllers\WantMovie\Add\AddController::class)
        ->name('want.movie.add');
    Route::post('/movies/bucket/add', \App\Http\Controllers\WantMovie\Add\CreateController::class)
        ->name('want.movie.create');
    Route::get('/movies/bucket/update/{movieId}', \App\Http\Controllers\WantMovie\Update\IndexController::class)
        ->name('want.movie.update.index');
    Route::post('/movies/bucket/update/{movieId}', \App\Http\Controllers\WantMovie\Update\PutController::class)
        ->name('want.movie.update.put');
    Route::delete('/movies/bucket/delete/{movieId}', \App\Http\Controllers\WantMovie\DeleteController::class)
        ->name('want.movie.delete');
    Route::post('movies/search', \App\Http\Controllers\WantMovie\SearchImageController::class)
        ->name('want.movie.search');
});





require __DIR__ . '/auth.php';
