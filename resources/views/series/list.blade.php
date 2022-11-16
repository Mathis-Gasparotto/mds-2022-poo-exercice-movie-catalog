@extends('layout')
@if(request()->query('genre'))
    @section('title', 'Series List - ' . request()->query('genre'))
@else
    @section('title', 'Series List')
@endif
@section('content')
    <div class="d-flex justify-content-center item-list-btn-container mb-5">
        @if(request()->query('orderBy'))
            @if(request()->query('order') == 'desc')
                <a href="{{route('series.list')}}?orderBy={{request()->query('orderBy')}}&order=asc" class="btn btn-primary">Asc order</a>
            @else
                <a href="{{route('series.list')}}?orderBy={{request()->query('orderBy')}}&order=desc" class="btn btn-primary">Desc order</a>
            @endif
        @endif
    </div>
    <div class="wrapper-grid">
        @foreach ($series as $singleSeries)
            <div class="item-card d-flex flex-column align-items-center">
                <a href="{{route('series.show', $singleSeries->id)}}" class="mb-3">
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
