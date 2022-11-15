@extends('layout')
@section('title', 'Series Genres')
@section('content')
    <ul>
        @foreach($genres as $genre)
            <li><a href="{{route('series.list')}}?genre={{$genre['label']}}">{{$genre['label']}}</a></li>
        @endforeach
    </ul>
@endsection
