@extends('layout')
@section('title', config('app.name'))
@section('content')
    <div class="single-random-movie mb-5">
        <h2 class="text-center mb-3">Single random movie</h2>
        <div class="item-card d-flex flex-column align-items-center">
            <a href="{{ route('movies.show', $randomMovie->id) }}" class="mb-2">
                <img src="{{ $randomMovie->poster }}" alt="{{ $randomMovie->primaryTitle }}" class="item-img">
            </a>
            <div class="item-title">
                <p class="text-center">{{ $randomMovie->primaryTitle }} ({{ $randomMovie->startYear }})</p>
            </div>
        </div>
    </div>
    <h2 class="text-center mb-3">Other movies</h2>
    <div class="wrapper-grid">
        @foreach ($movies as $movie)
            <div class="item-card d-flex flex-column align-items-center">
                <a href="{{ route('movies.show', $movie->id) }}" class="mb-2">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->primaryTitle }}" class="item-img">
                </a>
                <div class="item-title">
                    <p class="text-center">{{ $movie->primaryTitle }} ({{ $movie->startYear }})</p>
                </div>
            </div>
        @endforeach
    </div>

@endsection
