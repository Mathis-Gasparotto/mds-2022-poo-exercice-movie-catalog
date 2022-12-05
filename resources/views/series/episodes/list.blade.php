@extends('layout')
@section('title', $series->primaryTitle . ' - Season ' . $season_num )
@section('content')
    <div class="item-list-btn-container d-flex justify-content-center mb-5">
        <a href="{{route('series.show', $series)}}" class="btn btn-primary">Back to the series page</a>
    </div>
    <table class="item-specs w-100">
        <tr>
            @if($season_num !== 'other')<th class="text-center">Episode number</th>@endif
            <th class="text-center">Title</th>
            <th class="text-center">Release Year</th>
            <th class="text-center">Runtime</th>
            <th class="text-center">Average Rating</th>
            <th class="text-center">Description</th>
            <!-- <th class="text-center">Genre(s)</th> -->
        </tr>
        @foreach($episodes as $episode)
            <tr>
                @if($season_num == 'other')
                    <td class="text-center">{{$episode->primaryTitle}}</td>
                @else
                    <td class="text-center"><a href="{{route('series.episodes.show', [$series, $season_num, $episode->pivot->episodeNumber])}}">{{$episode->pivot->episodeNumber}}</a></td>
                    <td class="text-center"><a href="{{route('series.episodes.show', [$series, $season_num, $episode->pivot->episodeNumber])}}">{{$episode->primaryTitle}}</a></td>
                @endif
                <td class="text-center">{{$episode->startYear}}</td>
                <td class="text-center">
                    @if($episode->runtimeMinutes){{$episode->runtimeMinutes}} minute(s)@endif
                </td>
                <td class="text-center">
                    @if($episode->averageRating && $episode->numVotes){{$episode->averageRating}} ({{$episode->numVotes}} votes)@endif
                </td>
                <td class="text-center">{{$episode->plot}}</td>
                <!-- <td>
                    @foreach($episode->genres as $genre)
                        {{$genre['label']}},
                    @endforeach
                </td> -->
            </tr>
        @endforeach
    </table>
@endsection
