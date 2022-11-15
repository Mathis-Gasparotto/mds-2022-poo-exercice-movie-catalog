@extends('layout')
@section('title', $series->primaryTitle . ' - Season ' . $season_num . ' - Episode ' . $episode->episodeNumber)
@section('content')
    <div>
        <div class="item-list-btn-container d-flex justify-content-center mb-5">
            <a href="{{route('series.episodes.list', [$series, $season_num])}}" class="btn btn-primary">Back to the episode list</a>
            <a href="{{route('series.show', $series)}}" class="btn btn-primary">Back to the series page</a>
        </div>
        @if($episode->poster)
            <div class="d-flex justify-content-center">
                <img src="{{ $episode->poster }}" alt="{{ $episode->primaryTitle }}" class="movie-img">
            </div>
        @endif

        <table class="item-specs mt-5 mb-5 w-100">
            @if($episode->primaryTitle)<tr><th>Title</th><td>{{$episode->primaryTitle}}</td></tr>@endif
            @if($episode->startYear)<tr><th>Release Year</th><td>{{$episode->startYear}}</td></tr>@endif
            @if($episode->plot)<tr><th>Description</th><td>{{$episode->plot}}</td></tr>@endif
            @if($episode->averageRating && $episode->numVotes)<tr><th>Average Rating</th><td>{{$episode->averageRating}}/10 ({{$episode->numVotes}} votes)</td></tr>@endif
            @if($episode->runtimeMinutes)<tr><th>Runtime</th><td>{{$episode->runtimeMinutes}} minute(s)</td></tr>@endif
            @if($episode->genres)<tr><th>Genre(s)</th><td>
                @foreach($episode->genres as $genre)
                    {{$genre['label']}},
                @endforeach
            </td></tr>@endif
        </table>
    </div>
@endsection
