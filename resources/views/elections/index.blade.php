@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Elections</h2>

    <a href="{{ route('elections.create') }}" class="btn btn-success mb-3">Create New Election</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($elections as $election)
            <tr>
                <td>{{ $election->title }}</td>
                <td>{{ $election->start_date }}</td>
                <td>{{ $election->end_date }}</td>
                <td>
                    <a href="{{ route('elections.show', $election->id) }}" class="btn btn-primary btn-sm">View</a>

                    <a href="{{ route('elections.edit', $election->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('elections.destroy', $election->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
