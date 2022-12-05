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

        // V1
        //$episodes = Episode::where('series_id', $singleSeries->id)->get();

        $episodes = $singleSeries->episodes;

        $seasons = [];
        $seasonsForCount = [];

        foreach ($episodes as $episode) {
            $seasonNumber = $episode->pivot->seasonNumber ? $episode->pivot->seasonNumber : 'other';
            if (!in_array($seasonNumber, $seasons))
            {
                $seasons[] = $seasonNumber;
            }
            if (!in_array($episode->pivot->seasonNumber, $seasonsForCount) && $episode->pivot->seasonNumber)
            {
                $seasonsForCount[] = $episode->pivot->seasonNumber;
            }
        }
        sort($seasons);
        $episodeCount = count($episodes);
        return view('series.show', ['singleSeries' => $singleSeries, 'seasons' => $seasons, 'episodeCount' => $episodeCount, 'seasonCount' => count($seasonsForCount)]);
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
            $series = $genre->series()
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
            $series = $genre->series()->paginate($pageMax);

        } else {
            $series = Series::paginate($pageMax);
        }
        Paginator::useBootstrapFive();
        return view('series.list', ['series' => $series]);
    }

    public function random()
    {
        /* redirect to random movie */
        $series = Series::inRandomOrder()->whereNotNull('poster')->first();
        return redirect()->route('series.show', $series);
        /* -------- */

        $series = Series::inRandomOrder()->whereNotNull('poster')->first();
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
        $seasonNumToSearch = $season_num == 'other' ? null : $season_num;
        $episodes = $series->episodes()
            ->wherePivot('seasonNumber', $seasonNumToSearch)
            ->orderBy('episodeNumber', 'asc') // Au final cela marche comme ça ;)
            ->get();
        if(!count($episodes)) {
            return redirect()->back();
        }
        return view('series.episodes.list', ['series' => $series, 'season_num' => $season_num, 'episodes' => $episodes]);
    }
}
