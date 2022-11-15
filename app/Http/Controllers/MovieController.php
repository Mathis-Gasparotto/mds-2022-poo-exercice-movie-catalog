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
        if(!$movie) {
            return redirect()->back();
        }
        return view('movies.show', ['movie' => $movie]);
    }

    public function list(Request $request)
    {
        $pageMax = 24;
        $orderOptions= [
            'primaryTitle',
            'startYear',
            'runtimeMinutes',
            'averageRating',
            'numVotes',
        ];
        if($request->query('orderBy') && $request->query('genre')) {
            if(!in_array($request->query('orderBy'), $orderOptions)) {
                return redirect()->back();
            }
            $genre = Genre::where('label', $request->query('genre'))
                ->first();
            if(!$genre) {
                return redirect()->back();
            }
            $movies = $genre->movies()
                ->orderBy($request->query('orderBy'), $request->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($request->query('orderBy')) {
            if(!in_array($request->query('orderBy'), $orderOptions)) {
                return redirect()->back();
            }
            $movies = Movie::orderBy($request->query('orderBy'), $request->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($request->query('genre')) {
            $genre = Genre::where('label', $request->query('genre'))
                ->first();
            if(!$genre) {
                return redirect()->back();
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
