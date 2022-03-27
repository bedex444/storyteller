@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row mb-3 mt-5">
        <div class="col-md-8 d-flex justify-content-between">
            <h4>View Admin</h4>
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="mt-5 row">
                <div class="col-md-8">
                    <div class="mb-4">
                        <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
                        <p id="name" class="form-control-plaintext">{{ $data->name }}</p>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-bold">{{ __('Description') }}</label>
                        <p id="description" class="form-control-plaintext" placeholder="Description">{{ $data->description }}</p>
                    </div>

                    <div class="mb-4">
                        @if(count($files))
                        <p class="mt-4 fw-bold">Images</p>
                        @foreach ($files as $file)
                            <li class="d-flex justify-content-between align-items-center">
                                <a href="{{ $file['url'] }}" target="_blank" title="View File">
                                    <img src="{{ $file['url'] }}" alt="Image" class="img-thumbnail" style="max-width: 200px;">
                                </a>
                            </li>
                        @endforeach
                        @endif
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12 d-flex justify-content-end">
                            <a href="{{ route('admins.index') }}" class="btn btn-outline-secondary">
                                BACK
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
