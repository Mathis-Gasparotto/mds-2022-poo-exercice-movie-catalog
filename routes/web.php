<?php

use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SeriesController;
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

Route::get('/movies/genres', [GenreController::class, 'listForMovies'])->name('genres.movies.list');

Route::get('/movies/{id}', [MovieController::class, 'show'])->where('id', '[0-9]+')->name('movies.show');

Route::get('/movies', [MovieController::class, 'list'])->name('movies.list');

Route::get('/series/random', [SeriesController::class, 'random'])->name('series.random');

Route::get('/series/genres', [GenreController::class, 'listForSeries'])->name('genres.series.list');

Route::get('/series/{id}/season/{season_num}/episode/{episode_num}', [SeriesController::class, 'episodesShow'])
    ->where('id', '[0-9]+')
    ->where('season_num', '\b(other)\b|[0-9]+')
    ->where('episode_num', '[0-9]+')
    ->name('series.episodes.show');

Route::get('/series/{id}/season/{season_num}', [SeriesController::class, 'episodesList'])
    ->where('id', '[0-9]+')
    ->where('season_num', '\b(other)\b|[0-9]+')
    ->name('series.episodes.list');

Route::get('/series/{id}', [SeriesController::class, 'show'])->where('id', '[0-9]+')->name('series.show');

Route::get('/series', [SeriesController::class, 'list'])->name('series.list');
