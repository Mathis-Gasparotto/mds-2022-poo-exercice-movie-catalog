<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Models\Movie;
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
    $movies = Movie::inRandomOrder()->whereNotNull('poster')->limit(12)->get();
    $randomMovie = Movie::inRandomOrder()->whereNotNull('poster')->first();
    return view('home', ['movies' => $movies, 'randomMovie' => $randomMovie]);
})->name('home');

Route::get('/movies/random', [MovieController::class, 'random'])->name('movies.random');

Route::get('/movies/{id}', [MovieController::class, 'show'])->where('id', '[0-9]+')->name('movies.show');

Route::get('/movies', [MovieController::class, 'list'])->name('movies.list');

Route::get('/genres', [GenreController::class, 'list'])->name('genres.list');
