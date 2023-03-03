<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // want_to
    Route::get('/', \App\Http\Controllers\WantMovie\IndexController::class);
    Route::get('/movies/want_to', \App\Http\Controllers\WantMovie\IndexController::class)
        ->name('want.movie.index');
    Route::get('/movies/want_to/add', \App\Http\Controllers\WantMovie\Add\AddController::class)
        ->name('want.movie.add');
    Route::post('/movies/want_to/add', \App\Http\Controllers\WantMovie\Add\CreateController::class)
        ->name('want.movie.create');
    Route::get('/movies/want_to/record/{movieId}', \App\Http\Controllers\WantMovie\Update\IndexController::class)
        ->name('want.movie.update.index');
    Route::post('/movies/want_to/record/{movieId}', \App\Http\Controllers\WantMovie\Update\PutController::class)
        ->name('want.movie.update.put');
    Route::post('/movies/delete/{movieId}', \App\Http\Controllers\WantMovie\DeleteController::class)
        ->name('want.movie.delete');

    // done
    Route::get('/movies/done', \App\Http\Controllers\DoneMovie\IndexController::class)
        ->name('done.movie.index');
    Route::get('movies/done/add', \App\Http\Controllers\DoneMovie\Add\AddController::class)
        ->name('done.movie.add');
    Route::post('/movies/done/add', \App\Http\Controllers\DoneMovie\Add\CreateController::class)
        ->name('done.movie.create');
    Route::get('/movies/done/record/{movieId}', \App\Http\Controllers\DoneMovie\Update\IndexController::class)
        ->name('done.movie.update.index');
    Route::post('/movies/done/record/{movieId}', \App\Http\Controllers\DoneMovie\Update\PutController::class)
        ->name('done.movie.update.put');


    Route::post('movies/search', \App\Http\Controllers\WantMovie\SearchImageController::class)
        ->name('want.movie.search');
});

require __DIR__ . '/auth.php';
