<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Genre;
use App\Models\Series;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class SeriesController extends Controller
{
    public function show($id)
    {
        $singleSeries = Series::find($id);
        if(!$singleSeries) {
            return redirect()->back();
        }
        $episodes = Episode::where('series_id', $singleSeries->id)->get();
        $seasons = [];
        foreach ($episodes as $episode) {
            if (!in_array($episode->seasonNumber, $seasons))
            {
                $seasons[] = $episode->seasonNumber;
            }
        }
        return view('series.show', ['singleSeries' => $singleSeries, 'seasons' => $seasons]);
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
            $series = $genre->movies()
                ->orderBy($request->query('orderBy'), $request->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($request->query('orderBy')) {
            if(!in_array($request->query('orderBy'), $orderOptions)) {
                return redirect()->back();
            }
            $series = Series::orderBy($request->query('orderBy'), $request->query('order', 'asc'))
                ->paginate($pageMax);
        } elseif($request->query('genre')) {
            $genre = Genre::where('label', $request->query('genre'))
                ->first();
            if(!$genre) {
                return redirect()->back();
            }
            $series = $genre->movies()->paginate($pageMax);

        } else {
            $series = Series::paginate($pageMax);
        }
        Paginator::useBootstrapFive();
        return view('series.list', ['series' => $series]);
    }

    public function random()
    {
        /* redirect to random movie */
        return redirect()->route('series.show', rand(1, Series::count()));
        /* -------- */

        $movie = Series::inRandomOrder()->whereNotNull('poster')->first();
        return view('series.show', ['singleSeries' => $singleSeries]);
    }

    public function episodesShow($id, $season_num, $episode_num)
    {
        $series = Series::find($id);
        if(!$series) {
            return redirect()->back();
        }
        $episode = $series->episodes()->where('seasonNumber', $season_num)->where('episodeNumber', $episode_num)->first();
        if(!$episode) {
            return redirect()->back();
        }
        return view('series.episodes.show', ['series' => $series, 'season_num' => $season_num, 'episode' => $episode]);
    }

    public function episodesList($id, $season_num)
    {
        $series = Series::find($id);
        if(!$series) {
            return redirect()->back();
        }
        $episodes = $series->episodes()->where('seasonNumber', $season_num)->get();
        if(!count($episodes)) {
            return redirect()->back();
        }
        return view('series.episodes.list', ['series' => $series, 'season_num' => $season_num, 'episodes' => $episodes]);
    }
}
