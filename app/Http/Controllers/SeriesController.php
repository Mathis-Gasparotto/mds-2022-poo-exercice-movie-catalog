<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class SeriesController extends Controller
{
    public function show($id)
    {
        $singleSeries = Series::find($id);
        return view('series.show', ['singleSeries' => $singleSeries]);
    }

    public function list(Request $request)
    {
        $pageMax = 24;
        if($request->query('orderBy') && $request->query('genre')) {
            $genre = Genre::where('label', $request->query('genre'))
                ->first();
            if(!$genre) {
                return redirect()->route('series.list');
            }
            $series = $genre->movies()
                ->orderBy($request->query('orderBy'), $request->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($request->query('orderBy')) {
            $series = Series::orderBy($request->query('orderBy'), $request->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($request->query('genre')) {
            $genre = Genre::where('label', $request->query('genre'))
                ->first();
            if(!$genre) {
                return redirect()->route('series.list');
            }
            $series = $genre->movies()->paginate($pageMax);

        } else {
            $series = Series::paginate($pageMax);
        }
        Paginator::useBootstrapFive();
        return view('series.list', ['series' => $series, 'genreLabel' => $request->query('genre')]);
    }

    public function random()
    {
        /* redirect to random movie */
        return redirect()->route('series.show', rand(1, Series::count()));
        /* -------- */

        $movie = Series::inRandomOrder()->whereNotNull('poster')->first();
        return view('series.show', ['singleSeries' => $singleSeries]);
    }
}
