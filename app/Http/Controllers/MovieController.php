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

    public function list(Request $resquest)
    {
        if($resquest->query('orderBy') && $resquest->query('order'))
        {
            $movies = Movie::orderBy($resquest->query('orderBy'), $resquest->query('order'))
                ->paginate(24);
        } else {
            $movies = Movie::paginate(24);
        }
        Paginator::useBootstrapFive();
        return view('movies.list', ['movies' => $movies]);
    }

}
