@extends('layout')
@if($genreLabel)
    @section('title', 'Movie List - ' . $genreLabel)
@else
    @section('title', 'Movie List')
@endif
@section('content')
    <!-- <table class="movies-list-table d-flex justify-content-center">
        <tr>
            <th>Title</th>
            <th class="text-center">Year</th>
            <th class="text-center">Average Rating</th>
        </tr>
        @foreach ($movies as $movie)
            <tr>
                <td><a href="{{route('movies.show', $movie->id)}}">{{$movie->primaryTitle}}</a></td>
                <td class="text-center">{{$movie->startYear}}</td>
                <td class="text-center">{{$movie->averageRating}}</td>
            </tr>
        @endforeach
    </table> -->
    <div class="d-flex justify-content-center movies-list-btn-container mb-5">
        <a href="{{route('movies.list')}}?orderBy=primaryTitle&order=asc" class="btn btn-primary">Sort by Title</a>
        <a href="{{route('movies.list')}}?orderBy=startYear&order=asc" class="btn btn-primary">Sort by Year Release</a>
    </div>
    <div class="wrapper-grid">
        @foreach ($movies as $movie)
            <div class="movie-card d-flex flex-column align-items-center">
                <a href="{{route('movies.show', $movie->id)}}" class="mb-2">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->primaryTitle }}" class="movie-img">
                </a>
                <div class="movie-title">
                    <p class="text-center">{{ $movie->primaryTitle }} ({{ $movie->startYear }})</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination-container mt-4 d-flex justify-content-center">
        {{ $movies->appends(request()->query())->links() }}
    </div>
@endsection
