@extends('layout')
@if(request()->query('genre'))
    @section('title', 'Movie List - ' . request()->query('genre'))
@else
    @section('title', 'Movie List')
@endif
@section('content')
    <div class="d-flex justify-content-center item-list-btn-container mb-5">
        @if(request()->query('order') == 'desc')
            <a href="{{route('movies.list')}}?orderBy={{request()->query('orderBy')}}&order=asc" class="btn btn-primary">Asc order</a>
        @else
            <a href="{{route('movies.list')}}?orderBy={{request()->query('orderBy')}}&order=desc" class="btn btn-primary">Desc order</a>
        @endif
    </div>
    <div class="wrapper-grid">
        @foreach ($movies as $movie)
            <div class="item-card d-flex flex-column align-items-center">
                <a href="{{route('movies.show', $movie->id)}}" class="mb-3">
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
