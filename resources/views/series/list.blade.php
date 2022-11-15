@extends('layout')
@if($genreLabel)
    @section('title', 'Series List - ' . $genreLabel)
@else
    @section('title', 'Series List')
@endif
@section('content')
    <div class="d-flex justify-content-center item-list-btn-container mb-5">
        <a href="{{route('series.list')}}?orderBy=primaryTitle&order=asc" class="btn btn-primary">Sort by Title</a>
        <a href="{{route('series.list')}}?orderBy=startYear&order=asc" class="btn btn-primary">Sort by Year Release</a>
    </div>
    <div class="wrapper-grid">
        @foreach ($series as $singleSeries)
            <div class="item-card d-flex flex-column align-items-center">
                <a href="{{route('series.show', $singleSeries->id)}}" class="mb-2">
                    <img src="{{ $singleSeries->poster }}" alt="{{ $singleSeries->primaryTitle }}" class="item-img">
                </a>
                <div class="item-title">
                    <p class="text-center">{{ $singleSeries->primaryTitle }} ({{ $singleSeries->startYear }})</p>
                </div>
            </div>
        @endforeach
    </div>
    <div class="pagination-container mt-4 d-flex justify-content-center">
        {{ $series->appends(request()->query())->links() }}
    </div>
@endsection
