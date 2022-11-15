<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class MovieController extends Controller
{
    public function show($id)
    {
        $movie = Movie::find($id);
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

    public function random()
    {
        /* redirect to random movie */
        return redirect(route('movies.show', rand(0, count(Movie::all())-1)));
        /* -------- */

        $movie = Movie::inRandomOrder()->whereNotNull('poster')->first();
        return view('movies.show', ['movie' => $movie]);
    }
}
