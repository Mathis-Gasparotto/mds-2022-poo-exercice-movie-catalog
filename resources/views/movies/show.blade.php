@extends('layout')
@section('title', $movie->primaryTitle)
@section('content')
    <div>
        @if($movie->poster)
            <div class="d-flex justify-content-center">
                <img src="{{ $movie->poster }}" alt="{{ $movie->primaryTitle }}" class="movie-img" onerror="this.src='no-image.jpg';">
            </div>
        @endif

        <table class="item-specs mt-5 mb-5 w-100">
            @if($movie->startYear)<tr><th>Year</th><td>{{$movie->startYear}}</td></tr>@endif
            @if($movie->plot)<tr><th>Description</th><td>{{$movie->plot}}</td></tr>@endif
            @if($movie->averageRating && $movie->numVotes)<tr><th>Average Rating</th><td>{{$movie->averageRating}}/10 ({{$movie->numVotes}} votes)</td></tr>@endif
            @if($movie->runtimeMinutes)<tr><th>Runtime</th><td>{{$movie->runtimeMinutes}} minute(s)</td></tr>@endif
            @if($movie->genres)<tr><th>Genre(s)</th><td>
                @foreach($movie->genres as $genre)
                    <a href="{{route('movies.list')}}?genre={{$genre['label']}}">{{$genre['label']}}</a>,
                @endforeach
            </td></tr>@endif
        </table>
    </div>
@endsection
