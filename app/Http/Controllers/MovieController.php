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

    public function list(Request $request)
    {
        $pageMax = 24;
        if($request->query('orderBy') && $request->query('genre')) {
            $genre = Genre::where('label', $request->query('genre'))
                ->first();
            if(!$genre) {
                return redirect()->route('movies.list');
            }
            $movies = $genre->movies()
                ->orderBy($request->query('orderBy'), $request->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($request->query('orderBy')) {
            $movies = Movie::orderBy($request->query('orderBy'), $request->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($request->query('genre')) {
            $genre = Genre::where('label', $request->query('genre'))
                ->first();
            if(!$genre) {
                return redirect()->route('movies.list');
            }
            $movies = $genre->movies()->paginate($pageMax);

        } else {
            $movies = Movie::paginate($pageMax);
        }
        Paginator::useBootstrapFive();
        return view('movies.list', ['movies' => $movies, 'genreLabel' => $request->query('genre')]);
    }

    public function random()
    {
        /* redirect to random movie */
        return redirect()->route('movies.show', rand(1, Movie::count()));
        /* -------- */

        $movie = Movie::inRandomOrder()->whereNotNull('poster')->first();
        return view('movies.show', ['movie' => $movie]);
    }
}
