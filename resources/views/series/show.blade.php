@extends('layout')
@section('title', $singleSeries->primaryTitle)
@section('content')
    <div>
        @if($singleSeries->poster)
            <div class="d-flex justify-content-center">
                <img src="{{ $singleSeries->poster }}" alt="{{ $singleSeries->primaryTitle }}" class="movie-img">
            </div>
        @endif

        <table class="item-specs mt-5 mb-5 w-100">
            @if($singleSeries->startYear)<tr><th>Year</th><td>{{$singleSeries->startYear}}</td></tr>@endif
            @if($singleSeries->plot)<tr><th>Description</th><td>{{$singleSeries->plot}}</td></tr>@endif
            @if($singleSeries->averageRating && $singleSeries->numVotes)<tr><th>Average Rating</th><td>{{$singleSeries->averageRating}}/10 ({{$singleSeries->numVotes}} votes)</td></tr>@endif
            @if($episodeCount && $seasons)<tr><th>Episode Number</th><td>{{$episodeCount}} episode(s) ({{count($seasons)}} season(s))</td></tr>@endif
            @if($singleSeries->genres)<tr><th>Genre(s)</th><td>
                @foreach($singleSeries->genres as $genre)
                    <a href="{{route('series.list')}}?genre={{$genre['label']}}">{{$genre['label']}}</a>,
                @endforeach
            </td></tr>@endif
        </table>
        <h2 class="text-center mt-4 mb-3">Seasons</h2>
        <ul>
            @foreach($seasons as $season)
                <li><a href="{{route('series.episodes.list', [$singleSeries, $season])}}">@if($season == 'other')Other @else Season {{$season}}@endif</a></li>
            @endforeach
        </ul>
    </div>
@endsection
