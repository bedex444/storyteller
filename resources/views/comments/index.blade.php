@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row mb-3 mt-5">
        <div class="col-md-8 d-flex justify-content-between">
            <h4>Comments</h4>
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Location</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->story->location_name }}</td>
                            <td>{{ $row->comment }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <a href="{{ route('comments.show', ['comment' => $row->id]) }}" class="btn btn-outline-secondary">
                                    View
                                </a>
                                <a href="{{ route('comments.destroy', ['comment' => $row->id]) }}" class="btn btn-outline-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @if(!count($data))
                        <tr>
                            <td colspan="5" class="text-center"> No record found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
