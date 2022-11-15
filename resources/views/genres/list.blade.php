@extends('layout')
@section('title', 'Movie Genres')
@section('content')
    <ul>
        @foreach($genres as $genre)
            <li><a href="{{route('movies.list')}}?genre={{$genre['label']}}">{{$genre['label']}}</a></li>
        @endforeach
    </ul>
@endsection
