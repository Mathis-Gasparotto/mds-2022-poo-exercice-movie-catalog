@extends('layout')
@section('title', config('app.name'))
@section('content')
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

@endsection
