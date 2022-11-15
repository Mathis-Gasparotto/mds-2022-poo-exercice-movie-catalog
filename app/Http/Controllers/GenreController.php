<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function listForMovies ()
    {
        $genres = Genre::all();
        return view('genres.movies.list', ['genres' => $genres]);
    }

    public function listForSeries ()
    {
        $genres = Genre::all();
        return view('genres.series.list', ['genres' => $genres]);
    }
}
