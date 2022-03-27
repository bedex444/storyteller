<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body class="antialiased">
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-light fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('homepage') }}">{{ config('app.name') }}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('homepage') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('stories') }}">Stories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact Us</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">My Dashboard</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link">Log in/Sign Up</a>
                            </li>

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                                </li>
                            @endif --}}
                        @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @php
        $slides = config('storyteller.slides');
        $regions = config('storyteller.regions');
    @endphp
    <main>
        <div id="homeSlider" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($slides as $key => $slide)
                    <div @class(['carousel-item', 'active' => $key === 0 ])">
                        <div class="container" style="max-height: 550px; overflow: hidden;">
                            <img src="{{ asset($slide['image']) }}" class="d-block w-100">
                            <div class="carousel-caption text-start">
                                <h1>{{ $slide['title'] }}</h1>
                                <p>{{ $slide['description'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="carousel-indicators row-cols-1 row-cols-sm-1 row-cols-md-3">
                @foreach ($slides as $key => $slide)
                    <div data-bs-target="#homeSlider" data-slide-to="{{ $key }}" @class(['active' => $key === 0])
                        @if($key === 0) aria-current="true" @endif>
                        <img src="{{ asset($slide['image']) }}" class="d-block w-100">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container">
            <h3 class="display-6 text-center">Latest Stories</h3>

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($stories as $story)
                    @php
                        $cover = Storage::url($story->cover);
                    @endphp
                    <div class="card shadow-sm">
                        <img src="{{ $cover }}" alt="{{ $story->name }}" class="card-img-top">
                        <div class="card-body">
                            <h3 class="mb-0">{{ $story->name }}</h3>
                            <p class="card-text">This is a wider card with supporting text below as a natural
                                lead-in to additional content. This content is a little bit longer.</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                                </div>
                                <small class="text-muted">9 mins</small>
                            </div>
                        </div>

                        <p class="card-text mb-auto">
                            {{ $story->story }}
                        </p>
                        {{-- <a href="{ { route('destination.view', ['destination' => $destination->id]) } }" class="stretched-link">View destination</a> --}}
                    </div>
            </div>
        </div>
        @endforeach
        </div>
        @if (!count($stories))
            <div class="row mb-5 p-5">
                <div class="col text-center">
                    <h5>No stories published yet.</h5>
                </div>
            </div>
        @endif
        </div>
        <!-- FOOTER -->
        <footer class="container mt-3 text-center">
            <p>&copy; 2022 {{ config('app.name') }}.</p>
        </footer>
    </main>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
        (() => {
            // var homeSlider = document.querySelector('#homeSlider')
            // var carousel = new bootstrap.Carousel(homeSlider)
            // console.log(carousel);
        })();
    </script>
</body>

</html>
