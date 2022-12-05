@extends('layout')
@section('title', 'Search Result - ' . request()->query('s'))
@section('content')
    <div class="wrapper-grid">
        @if(!$results)
            <div class="alert alert-danger text-center h2" role="alert">
                No result found
            </div>
        @else
            @foreach ($results as $result)
                <div class="item-card d-flex flex-column align-items-center">
                    @if($result->type == 'movie')
                        <a href="{{route('movies.show', $result->id)}}" class="mb-3">
                            <img src="{{ $result->poster }}" alt="{{ $result->primaryTitle }}" onerror="this.src='no-image.jpg';" class="item-img">
                        </a>
                    @elseif($result->type == 'series')
                        <a href="{{route('series.show', $result->id)}}" class="mb-3">
                            <img src="{{ $result->poster }}" alt="{{ $result->primaryTitle }}" onerror="this.src='no-image.jpg';" class="item-img">
                        </a>
                    @elseif($result->type == 'episode')
                        @if($result->episodeNumber)
                            <a href="{{route('series.episodes.show', [$result->series_id, $result->seasonNumber , $result->episodeNumber ])}}" class="mb-3">
                                <img src="{{ $result->poster }}" alt="{{ $result->primaryTitle }}" onerror="this.src='no-image.jpg';" class="item-img">
                            </a>
                        @else
                            <img src="{{ $result->poster }}" alt="{{ $result->primaryTitle }}" onerror="this.src='no-image.jpg';" class="item-img">
                        @endif
                    @endif
                    <div class="item-title">
                        <p class="text-center">{{ $result->primaryTitle }} ({{ $result->startYear }})</p>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
