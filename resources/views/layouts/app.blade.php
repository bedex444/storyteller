<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @if (session('success') || session('error'))
    <div class="toast-container position-absolute p-3 top-0 start-50 translate-middle-x" id="toast-wrapper">
        <div @class(['toast align-items-center text-white border-0', 'bg-success' => session('success'),
        'bg-danger' => session('error')]) role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    @if (session('success'))
                        {{ session('success') }}
                    @endif
                    @if (session('error'))
                        {{ session('error') }}
                    @endif
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>
    @endif

    <main class="overflow-auto">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                @include('sidemenu')
                <div class="col py-3">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="container p-3 bg-white text-center">
        <p>&copy; 2022 {{ config('app.name') }}.</p>
    </footer>

    <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}">
    </script>
    <script src="{{ asset('js/menu.js') }}"></script>

    <script>
        (function () {
            var toastElList = [].slice.call(document.querySelectorAll('.toast'));
            var toastList = toastElList.map(function (toastEl) {
                return new bootstrap.Toast(toastEl)
            });

            toastList.forEach(element => {
                element.show();
            });
        })();
    </script>
</body>
</html>
