@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row mb-3 mt-5">
        <div class="col-md-8 d-flex justify-content-between">
            <h4>Update Destination</h4>
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="mt-5 row">
                <div class="col-md-8">
                    <form method="POST" action="{{ route('destinations.update', ['destination' => $data->id]) }}" enctype="multipart/form-data" autocomplete="off">
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
                            <label for="description" class="form-label">{{ __('Description') }}</label>

                            <textarea id="description" rows="10" class="form-control @error('description') is-invalid @enderror" name="description" required placeholder="Description">{{ old('description', $data->description) }}</textarea>

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="images" class="form-label">{{ __('Images') }}</label>

                            <input type="file" id="images" multiple class="form-control @error('images') is-invalid @enderror" name="images[]" required placeholder="Select images" accept="image/*">
                            <small class="text-muted">Multiple files are allowed</small>

                            @error('images')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            @if(count($files))
                            <p class="mt-4">Uploaded Images</p>
                            <ul class="list-group">
                                @foreach ($files as $file)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ $file['url'] }}" target="_blank" title="View File">{{ $file['name'] }}</a>
                                        <a href="{{ route('destinations.delete-file', ['destination' => $data->id, 'file' => $file['name']]) }}" class="btn btn-sm btn-danger rounded-pill">delete</a>
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-3">
                                    SAVE
                                </button>
                                <a href="{{ route('destinations.index') }}" class="btn btn-outline-secondary">
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
