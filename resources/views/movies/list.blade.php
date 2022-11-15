@extends('layout')
@if($genreLabel)
    @section('title', 'Movie List - ' . $genreLabel)
@else
    @section('title', 'Movie List')
@endif
@section('content')
    <div class="d-flex justify-content-center item-list-btn-container mb-5">
        <a href="{{route('movies.list')}}?orderBy=primaryTitle&order=asc" class="btn btn-primary">Sort by Title</a>
        <a href="{{route('movies.list')}}?orderBy=startYear&order=asc" class="btn btn-primary">Sort by Year Release</a>
    </div>
    <div class="wrapper-grid">
        @foreach ($movies as $movie)
            <div class="item-card d-flex flex-column align-items-center">
                <a href="{{route('movies.show', $movie->id)}}" class="mb-2">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->primaryTitle }}" class="item-img">
                </a>
                <div class="item-title">
                    <p class="text-center">{{ $movie->primaryTitle }} ({{ $movie->startYear }})</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination-container mt-4 d-flex justify-content-center">
        {{ $movies->appends(request()->query())->links() }}
    </div>
@endsection
