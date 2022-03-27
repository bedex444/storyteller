@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row mb-3 mt-5">
        <div class="col-md-8 d-flex justify-content-between">
            <h4>Update Administrator</h4>
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="mt-5 row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('admins.update', ['admin' => $data->id]) }}" autocomplete="off">
                        @csrf
                        @method('put')

                        <div class="mb-4">
                            <label for="name" class="form-label">{{ __('Name') }}</label>

                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $data->name) }}" required autocomplete="name" autofocus placeholder="Name">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Email Address') }}</label>

                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $data->email) }}" required autocomplete="email" autofocus placeholder="Email address">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Password') }}</label>

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password-confirm" class="form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
                        </div>

                        <div class="mb-4">
                            <label for="status" class="form-label">{{ __('Status') }}</label>

                            <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                                @foreach (['1' => 'Active', '0' => 'Inactive'] as $key => $val)
                                    <option value="{{ $key }}" @selected(old('status', $data->status) == $key)>
                                        {{ $val }}
                                    </option>
                                @endforeach
                            </select>

                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-3">
                                    SAVE
                                </button>
                                <a href="{{ route('admins.index') }}" class="btn btn-outline-secondary">
                                    CANCEL
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
