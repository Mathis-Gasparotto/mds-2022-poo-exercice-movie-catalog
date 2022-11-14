@extends('layout')
@section('title', config('app.name'))
@section('content')
    <div class="wrapper-grid">
        @foreach ($movies as $movie)
        <a href="/movies/{{ $movie->id }}">
            <img src="{{ $movie->poster }}" alt="{{ $movie->primaryTitle }}">
        </a>
        @endforeach
    </div>

@endsection
