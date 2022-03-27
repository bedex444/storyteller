@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row mb-3 mt-5">
        <div class="col-md-8 d-flex justify-content-between">
            <h4>Destinations</h4>
            <a href="{{ route('destinations.create') }}" class="btn btn-primary">Add Destination</a>
        </div>
    </div>
    <div class="row justify-content-start">
        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th>Name</th>
                        <th>Story Teller</th>
                        <th>Date</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->storyteller->name }}</td>
                            <td>{{ $row->created_at }}</td>
                            <td>
                                <a href="{{ route('destinations.show', ['destination' => $row->id]) }}" class="btn btn-outline-primary">
                                    View
                                </a>
                                <a href="{{ route('destinations.edit', ['destination' => $row->id]) }}" class="btn btn-outline-secondary">
                                    Edit
                                </a>
                                <a href="{{ route('destinations.destroy', ['destination' => $row->id]) }}" class="btn btn-outline-danger">
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
