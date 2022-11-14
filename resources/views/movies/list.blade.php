@extends('layout')
@section('title', 'Movie List')
@section('content')
    <!-- <table class="movies-list-table d-flex justify-content-center">
        <tr>
            <th>Title</th>
            <th class="text-center">Year</th>
            <th class="text-center">Average Rating</th>
        </tr>
        @foreach ($movies as $movie)
            <tr>
                <td><a href="{{route('movies.show', $movie->id)}}">{{$movie->primaryTitle}}</a></td>
                <td class="text-center">{{$movie->startYear}}</td>
                <td class="text-center">{{$movie->averageRating}}</td>
            </tr>
        @endforeach
    </table> -->
    <div class="wrapper-grid">
        @foreach ($movies as $movie)
            <div class="movie-card d-flex flex-column align-items-center">
                <a href="{{route('movies.show', $movie->id)}}" class="mb-2">
                    <img src="{{ $movie->poster }}" alt="{{ $movie->primaryTitle }}" class="movie-img">
                </a>
                <p>{{ $movie->primaryTitle }}</p>
            </div>
        @endforeach
    </div>
    <div class="pagination-container mt-4 d-flex justify-content-center">
        @if($resquest->query('orderBy') && $resquest->query('order'))
            @foreach($movies->linkCollection() as $link)
                <a href="{{$link['url']}}&orderBy={{$resquest->query('orderBy')}}&order={{$resquest->query('order')}}" class="btn btn-primary @if($link['active']) active @endif @if(!$link['url']) disabled @endif">{{str_replace(['&laquo; ', ' &raquo;'], '', $link['label'])}}</a>
            @endforeach
        @else
            {{ $movies->links() }}
        @endif
    </div>
@endsection
