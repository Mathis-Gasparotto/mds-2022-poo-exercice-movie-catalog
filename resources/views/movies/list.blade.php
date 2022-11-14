@extends('layout')
@section('title', 'Movies List')
@section('content')
    <table>
        <tr>
            <th>Title</th>
            <th>Year</th>
            <th>Average Rating</th>
        </tr>
        @foreach ($movies as $movie)
            <tr>
                <td>{{$movie->primaryTitle}}</td>
                <td>{{$movie->startYear}}</td>
                <td>{{$movie->averageRating}}</td>
            </tr>
        @endforeach
    </table>
@endsection
