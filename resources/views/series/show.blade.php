@extends('layout')
@section('title', $singleSeries->primaryTitle)
@section('content')
    <div>
        <div class="d-flex justify-content-center">
            <img src="{{ $singleSeries->poster }}" alt="{{ $singleSeries->primaryTitle }}" class="movie-img">
        </div>

        <table class="item-specs mt-5 mb-5">
            <tr><th>Year</th><td>{{$singleSeries->startYear}}</td></tr>
            <tr><th>Description</th><td>{{$singleSeries->plot}}</td></tr>
            <tr><th>Average Rating</th><td>{{$singleSeries->averageRating}}/10 ({{$singleSeries->numVotes}} votes)</td></tr>
            <tr><th>Runtime</th><td>{{$singleSeries->runtimeMinutes}} minutes</td></tr>
        </table>
        <h2 class="text-center mt-4 mb-3">Seasons</h2>
        <ul>
            @foreach($seasons as $season)
                <li><a href="{{route('series.episodes.list', [$singleSeries, $season])}}">Season {{$season}}</a></li>
            @endforeach
        </ul>
    </div>
@endsection
