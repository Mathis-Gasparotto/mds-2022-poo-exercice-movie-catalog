@extends('layout')
@section('title', 'Search Result - ' . request()->query('s'))
@section('content')
    @if(empty($results))
        <div class="alert alert-danger text-center h2" role="alert">
            No result found
        </div>
    @else
        <div class="wrapper-grid">
            @foreach ($results as $result)
                <div class="item-card d-flex flex-column align-items-center">
                    @if($result->titleType == 'movie')
                        <a href="{{route('movies.show', $result->id)}}" class="mb-3">
                            <img src="{{ $result->poster }}" alt="{{ $result->primaryTitle }}" onerror="this.src='no-image.jpg';" class="item-img">
                        </a>
                    @elseif($result->titleType == 'tvSeries' || $result->titleType == 'tvMiniSeries')
                        <a href="{{route('series.show', $result->id)}}" class="mb-3">
                            <img src="{{ $result->poster }}" alt="{{ $result->primaryTitle }}" onerror="this.src='no-image.jpg';" class="item-img">
                        </a>
                    @elseif($result->titleType == 'tvEpisode')
                        <img src="{{ $result->poster }}" alt="{{ $result->primaryTitle }}" onerror="this.src='no-image.jpg';" class="item-img">
                    @endif
                    <div class="item-title">
                        <p class="text-center">{{ $result->primaryTitle }} ({{ $result->startYear }})</p>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-container mt-4 d-flex justify-content-center">
            {{ $results->appends(request()->query())->links() }}
        </div>
    @endif
@endsection
