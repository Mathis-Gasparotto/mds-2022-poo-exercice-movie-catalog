@extends('layout')
@section('title', $series->primaryTitle . ' - Season ' . $season_num )
@section('content')
    <div class="item-list-btn-container d-flex justify-content-center mb-5">
        <a href="{{route('series.show', $series)}}" class="btn btn-primary">Back to the series page</a>
    </div>
    <table class="item-specs">
        <tr>
            <th class="text-center">Episode number</th>
            <th class="text-center">Title</th>
            <th class="text-center">Release Year</th>
            <th class="text-center">Runtime</th>
            <th class="text-center">Average Rating</th>
            <th class="text-center">Description</th>
        </tr>
        @foreach($episodes as $episode)
            <tr>
                <td class="text-center"><a href="{{route('series.episodes.show', [$series, $season_num, $episode->episodeNumber])}}">{{$episode->episodeNumber}}</a></td>
                <td class="text-center"><a href="{{route('series.episodes.show', [$series, $season_num, $episode->episodeNumber])}}">{{$episode->primaryTitle}}</a></td>
                <td class="text-center">{{$episode->startYear}}</td>
                <td class="text-center">{{$episode->runtimeMinutes}} minutes</td>
                <td class="text-center">{{$episode->averageRating}} ({{$episode->numVotes}} votes)</td>
                <td class="text-center">{{$episode->plot}}</td>
            </tr>
        @endforeach
    </table>
@endsection
