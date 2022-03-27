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

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
@php
$cover = Storage::url($story->cover);

$pictures = json_decode($story->pictures);

$files = [];

foreach ($pictures as $image) {
    $files[] = Storage::url($image);
}
@endphp

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
                            <a class="nav-link" aria-current="page" href="{{ route('homepage') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ route('list-stories') }}">Stories</a>
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

    <main class="mt-5">
        <div class="container p-3">
            <div class="row my-3">
                <div class="col-md-12 text-center">
                    <h2 class="mt-2 fw-bold">{{ $story->location_name }}</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-1 h-25 overflow-hidden">
                    @if (count($files))
                        <img src="{{ asset($files[0]) }}" alt="{{ $story->name }}" class="img-fluid">
                    @else
                        <img src="https://via.placeholder.com/200x150" alt="No Picture">
                    @endif
                </div>
                @if (count($files) > 0)
                    <div class="col-md-10 offset-1">
                        <div class="row mt-2 mb-3">
                            @foreach ($files as $idx => $file)
                                <div class="col-md-3 overflow-hidden" style="height: 200px; overflow:hidden;">
                                    <a href="{{ asset($file) }}" target="_blank" title="View Image"><img
                                            src="{{ asset($file) }}" class="img-thumbnail"></a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <div class="row mt-3">
                <div class="col-md-8 offset-md-1">
                    <h3 class="fw-bold mb-2">Story</h3>
                    <p>{{ $story->story }}</p>
                </div>
                <div class="col-md-2">
                    <h3 class="fw-bold mb-2">REGIONS</h3>
                    <ul class="nav flex-column">
                        @foreach (config('storyteller.regions') as $region)
                        <li class="nav-item region-nav">
                            <a @class(["nav-link", "active" => $region === $story->region ]) @if($region === $story->region) aria-current="page" @endif href="{{ route('list-stories', ['region' => $region ]) }}">{{ $region }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-8 offset-md-1">
                    <h4 class="fw-bold">Comments</h4>
                    @if (count($story->comments))
                        <ul class="list-group list-group-flush">
                            @foreach ($story->comments as $comment)
                                <li class="list-group-item  d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold mb-2">{{ $comment->name }} -
                                            {{ $comment->created_at->format('j M, Y h:i a') }}</div>
                                        <p>{{ $comment->comment }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>No Comment</p>
                    @endif
                </div>
            </div>
            <div class="row mt-3 mb-5">
                <div class="col-md-5 offset-md-1">
                    <h5>Add Comment</h5>
                    <form method="POST" action="{{ route('add-comment', ['story' => $story->id]) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" class="form-control" id="name" name="name"
                                placeholder="Enter your name" required value="{{ old('name') }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Comment or Question</label>
                            <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Enter your comment or question"
                                required>{{ old('comment') }}</textarea>

                            @error('comment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- FOOTER -->
        <footer class="container text-center">
            <p>&copy; 2022 {{ config('app.name') }}.</p>
        </footer>
    </main>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
</body>

</html>
