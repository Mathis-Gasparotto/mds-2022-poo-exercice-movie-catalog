@extends('layout')
@section('title', $movie->primaryTitle)
@section('content')
    <div>
        <div class="d-flex justify-content-center">
            <img src="{{ $movie->poster }}" alt="{{ $movie->primaryTitle }}" class="movie-img">
        </div>

        <table class="item-specs mt-5 mb-5">
            <tr><th>Year</th><td>{{$movie->startYear}}</td></tr>
            <tr><th>Description</th><td>{{$movie->plot}}</td></tr>
            <tr><th>Average Rating</th><td>{{$movie->averageRating}}/10 ({{$movie->numVotes}} votes)</td></tr>
            <tr><th>Runtime</th><td>{{$movie->runtimeMinutes}} minutes</td></tr>
        </table>
    </div>
@endsection
