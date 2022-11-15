<?php

namespace App\Http\Controllers;

use App\Models\Genre;
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
        $pageMax = 24;
        if($resquest->query('orderBy') && $resquest->query('genre')) {
            $genre = Genre::where('label', $resquest->query('genre'))
                ->first();
            if(!$genre) {
                return redirect()->route('movies.list');
            }
            $movies = $genre->movies()
                ->orderBy($resquest->query('orderBy'), $resquest->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($resquest->query('orderBy')) {
            $movies = Movie::orderBy($resquest->query('orderBy'), $resquest->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($resquest->query('genre')) {
            $genre = Genre::where('label', $resquest->query('genre'))
                ->first();
            if(!$genre) {
                return redirect()->route('movies.list');
            }
            $movies = $genre->movies()->paginate($pageMax);

        } else {
            $movies = Movie::paginate($pageMax);
        }
        Paginator::useBootstrapFive();
        return view('movies.list', ['movies' => $movies, 'genreLabel' => $resquest->query('genre')]);
    }

    public function random()
    {
        /* redirect to random movie */
        return redirect()->route('movies.show', rand(1, count(Movie::all())));
        /* -------- */

        $movie = Movie::inRandomOrder()->whereNotNull('poster')->first();
        return view('movies.show', ['movie' => $movie]);
    }
}
