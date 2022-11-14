@extends('layout')
@section('title', $movie->primaryTitle)
@section('content')
    <div>
        <a href="/movies/{{ $movie->id }}">
            <img src="{{ $movie->poster }}" alt="{{ $movie->primaryTitle }}">
        </a>
        <table>
            <tr>
                <th>Year</th>
                <th>Description</th>
                <th>Average Rating</th>
            </tr>
            <tr>
                <td>{{$movie->startYear}}</td>
                <td>{{$movie->plot}}</td>
                <td>{{$movie->averageRating}}</td>
            </tr>
        </table>
    </div>
@endsection
