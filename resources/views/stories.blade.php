<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

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
                            <a class="nav-link" href="{{ route('list-stories') }}">Stories</a>
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
                        @endauth
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    @php
        $regions = config('storyteller.regions');
    @endphp
    <main class="mt-5">
        <div class="container p-3">
            <div class="row my-5">
                <div class="col-md-12 text-center">
                    <h2 class="my-5 display-6 fw-bold">Stories</h2>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="mb-3">
                        <form id="region-form" action="{{ route('list-stories') }}" method="GET">
                            <label for="region" class="form-label">Filter by region</label>
                            <select class="form-select" aria-label="Select a region" name="region"
                                onchange="document.getElementById('region-form').submit();">
                                <option value="">All</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region }}" @selected(request()->query('region', null) === $region)>
                                        {{ $region }}</option>
                                @endforeach
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                @foreach ($stories as $story)
                    @php
                        $cover = Storage::url($story->cover);
                        $content = $story->story;

                        if (strlen($content) > 120) {
                            $content = Str::substr($content, 0, 120) . '...';
                        }
                    @endphp
                    <div class="card shadow-sm">
                        <img src="{{ $cover }}" alt="{{ $story->name }}" class="card-img-top">
                        <div class="card-body">
                            <h4 class="mb-3">{{ $story->location_name }}</h4>
                            <p class="card-text">{{ $content }}</p>
                            <div class="d-flex justify-content-end align-items-center">
                                <a href="{{ route('view-story', ['story' => $story->id]) }}"
                                    class="btn btn-sm btn-outline-secondary">READ MORE</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if (!count($stories))
                <div class="row mb-5 p-5">
                    <div class="col text-center">
                        <h5>No story found.</h5>
                    </div>
                </div>
            @endif
        </div>
        <!-- FOOTER -->
        <footer class="container mt-3 text-center">
            <p>&copy; 2022 {{ config('app.name') }}.</p>
        </footer>
    </main>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}">
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
