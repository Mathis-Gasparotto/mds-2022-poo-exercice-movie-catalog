<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/style/app.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{route('home')}}">Moviiiies</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav pl-3 pr-3">
                <li class="nav-item @if(request()->routeIs('home')) active @endif">
                    <a class="nav-link" href="{{route('home')}}">Home</a>
                </li>
                <li class="nav-item @if(request()->routeIs('movies.random')) active @endif">
                    <a class="nav-link" href="{{route('movies.random')}}">Random Movie</a>
                </li>
                <li class="nav-item @if(request()->routeIs('movies.list')) active @endif">
                    <a class="nav-link" href="{{route('movies.list')}}">Global Movies List</a>
                </li>
                <li class="nav-item @if(request()->routeIs('genres.list')) active @endif">
                    <a class="nav-link" href="{{route('genres.list')}}">Movies Genres</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="{{route('movies.list')}}" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Movies Orders
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="{{route('movies.list')}}?orderBy=primaryTitle&order=asc">Sort by Title</a>
                        <a class="dropdown-item" href="{{route('movies.list')}}?orderBy=startYear&order=asc">Sort by Year Release</a>
                    </div>
                </li>
                <li class="nav-item @if(request()->routeIs('series.random')) active @endif">
                    <a class="nav-link" href="{{route('series.random')}}">Random Series</a>
                </li>
                <li class="nav-item @if(request()->routeIs('series.list')) active @endif">
                    <a class="nav-link" href="{{route('series.list')}}">Global Series List</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container pb-5">
        <h1 class="text-center mb-5 mt-3">@yield('title')</h1>
        <div class="wrapper">
            @yield('content')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
