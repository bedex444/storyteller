@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row mb-3 mt-5">
            <div class="col-md-8 d-flex justify-content-between">
                <h4>View Comment</h4>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-8">
                <div class="mt-5 row">
                    <div class="col-md-8">
                        <div class="mb-2 row">
                            <label for="name" class="col-md-4 col-form-label fw-bold">Destination</label>
                            <p id="name" class="col-md-8 form-control-plaintext">{{ $data->destination->name }}</p>
                        </div>
                        <hr>
                    </div>
                </div>
                <div class="mt-3 row">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
                            <p id="name" class="form-control-plaintext">{{ $data->name }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="comment" class="form-label fw-bold">{{ __('Comment/Question') }}</label>
                            <p id="comment" class="form-control-plaintext">{{ $data->comment }}</p>
                        </div>

                        <div class="mb-4">
                            <label for="date" class="form-label fw-bold">{{ __('Date') }}</label>
                            <p id="date" class="form-control-plaintext">
                                {{ $data->created_at->format('jS \\of F, Y h:i A') }}</p>
                        </div>

                        <hr>
                        <div class="mb-4">
                            <h5>Reply Comment</h5>
                            <form method="POST" action="{{ route('comments.reply', ['comment' => $data->id]) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Response</label>
                                    <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Enter your response" required>{{ old('comment') }}</textarea>

                                    @error('comment')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">Send Response</button>
                            </form>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12 d-flex justify-content-end">
                                <a href="{{ route('comments.index') }}" class="btn btn-outline-secondary">
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
