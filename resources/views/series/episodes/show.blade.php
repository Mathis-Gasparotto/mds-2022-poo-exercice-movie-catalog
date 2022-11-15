@extends('layout')
@section('title', $series->primaryTitle . ' - Season ' . $season_num . ' - Episode ' . $episode->episodeNumber)
@section('content')
    <div>
        <div class="item-list-btn-container d-flex justify-content-center mb-5">
            <a href="{{route('series.episodes.list', [$series, $season_num])}}" class="btn btn-primary">Back to the episode list</a>
            <a href="{{route('series.show', $series)}}" class="btn btn-primary">Back to the series page</a>
        </div>
        <div class="d-flex justify-content-center">
            <img src="{{ $episode->poster }}" alt="{{ $episode->primaryTitle }}" class="movie-img">
        </div>

        <table class="item-specs mt-5 mb-5">
            <tr><th>Title</th><td>{{$episode->primaryTitle}}</td></tr>
            <tr><th>Release Year</th><td>{{$episode->startYear}}</td></tr>
            <tr><th>Description</th><td>{{$episode->plot}}</td></tr>
            <tr><th>Average Rating</th><td>{{$episode->averageRating}}/10 ({{$episode->numVotes}} votes)</td></tr>
            <tr><th>Runtime</th><td>{{$episode->runtimeMinutes}} minutes</td></tr>
        </table>
    </div>
@endsection
