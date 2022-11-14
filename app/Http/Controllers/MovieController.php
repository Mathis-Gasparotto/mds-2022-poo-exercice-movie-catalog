<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class MovieController extends Controller
{
    public function show($id)
    {
        $movie = Movie::where('id', $id)->first();
        return view('movies.show', ['movie' => $movie]);
    }

    public function list()
    {
        $movies = Movie::paginate(20);
        Paginator::useBootstrapFive();
        return view('movies.list', ['movies' => $movies]);
    }
}
