<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function show($id)
    {
        $movie = Movie::where('id', $id)->first();
        return view('movies.show', ['movie' => $movie]);
    }

}
