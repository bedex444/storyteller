@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-start">
            <div class="col-md-8 m-5">
                <div class="h4">Welcome back {{ auth()->user()->name }}</div>
            </div>
        </div>

        <div class="row justify-content-start">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center p-5">
                        <div class="row">
                            <div class="col-5">
                                <h2 class="display-3 fw-bold">
                                    {{ $stories }}
                                </h2>
                            </div>
                            <div class="col-auto">
                                <h3>Stories</h3>
                                <a href="{{ route('stories.index') }}">view</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (auth()->user()->is_admin)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-center p-5">
                            <div class="row">
                                <div class="col-5">
                                    <h2 class="display-3 fw-bold">
                                        {{ $users }}
                                    </h2>
                                </div>
                                <div class="col-auto">
                                    <h3>Users</h3>
                                    <a href="{{ route('users.index') }}">view</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
