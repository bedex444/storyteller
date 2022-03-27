@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row mb-3 mt-5">
        <div class="col-md-8 d-flex justify-content-between">
            <h4>Stories</h4>
            <a href="{{ route('stories.create') }}" class="btn btn-primary">Add Story</a>
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-md-8">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Location</th>
                        <th>Region</th>
                        <th>Story Teller</th>
                        <th>Date</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->location_name }}</td>
                            <td>{{ $row->region }}</td>
                            <td>{{ $row->user->name }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <a href="{{ route('view-story', ['story' => $row->id]) }}" target="_blank" class="btn btn-outline-primary">
                                    View
                                </a>
                                <a href="{{ route('stories.edit', ['story' => $row->id]) }}" class="btn btn-outline-secondary">
                                    Edit
                                </a>
                                <a href="{{ route('stories.destroy', ['story' => $row->id]) }}" class="btn btn-outline-danger">
                                    Delete
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @if(!count($data))
                        <tr>
                            <td colspan="6" class="text-center"> No record found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
