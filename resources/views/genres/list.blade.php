@extends('layout')
@section('title', 'Movie Genres')
@section('content')
    <ul>
        @foreach($genres as $genre)
            <li>{{$genre['label']}}</li>
        @endforeach
    </ul>
@endsection
