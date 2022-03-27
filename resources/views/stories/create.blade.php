@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row mb-3 mt-5">
        <div class="col-md-8 d-flex justify-content-between">
            <h4>Add Story</h4>
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="mt-5 row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('stories.store') }}" enctype="multipart/form-data" autocomplete="off">
                        @csrf

                        <div class="mb-4">
                            <label for="location_name" class="form-label">{{ __('Location Name') }}</label>

                            <input id="location_name" type="text" class="form-control @error('location_name') is-invalid @enderror" name="location_name" value="{{ old('location_name') }}" required autocomplete="name" autofocus placeholder="Location Name">

                            @error('location_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="region" class="form-label">{{ __('Region') }}</label>

                            <select id="region" class="form-control form-select @error('region') is-invalid @enderror" name="region" required>
                                @foreach (config('storyteller.regions') as $val)
                                    <option value="{{ $val }}" @selected(old('region') == $val)>
                                        {{ $val }}
                                    </option>
                                @endforeach
                            </select>

                            @error('region')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="story" class="form-label">{{ __('Story') }}</label>

                            <textarea id="story" rows="10" class="form-control @error('story') is-invalid @enderror" name="story" required placeholder="Story">{{ old('story') }}</textarea>

                            @error('story')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="cover" class="form-label">{{ __('Cover Image') }}</label>

                            <input type="file" id="cover" class="form-control @error('cover') is-invalid @enderror" name="cover" required placeholder="Select an image" accept="image/*">

                            @error('cover')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="pictures" class="form-label">{{ __('Pictures') }}</label>

                            <input type="file" id="pictures" multiple class="form-control @error('pictures') is-invalid @enderror" name="pictures[]" required placeholder="Select images" accept="image/*">
                            <small class="text-muted">Multiple files are allowed</small>

                            @error('pictures')
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
                                <a href="{{ route('stories.index') }}" class="btn btn-outline-secondary">
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
