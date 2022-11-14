@extends('layout')
@section('title', 'Movies List')
@section('content')
    <!-- <table class="movies-list-table d-flex justify-content-center">
        <tr>
            <th>Title</th>
            <th class="text-center">Year</th>
            <th class="text-center">Average Rating</th>
        </tr>
        @foreach ($movies as $movie)
            <tr>
                <td><a href="/movies/{{ $movie->id }}">{{$movie->primaryTitle}}</a></td>
                <td class="text-center">{{$movie->startYear}}</td>
                <td class="text-center">{{$movie->averageRating}}</td>
            </tr>
        @endforeach
    </table> -->
    <div class="wrapper-grid">
        @foreach ($movies as $movie)
            <div class="movie-card d-flex flex-column align-items-center">
                <a href="/movies/{{ $movie->id }}" class="mb-2">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->primaryTitle }}" class="movie-img">
                </a>
                <p>{{ $movie->primaryTitle }}</p>
            </div>
        @endforeach
    </div>
    <div class="pagination-container mt-4">
        {{ $movies->links() }}
    </div>
@endsection
