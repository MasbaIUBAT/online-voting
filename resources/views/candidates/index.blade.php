@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Candidates Management</h2>

    <a href="{{ route('candidates.create') }}" class="btn btn-primary mb-3">Add Candidate</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Party</th>
                <th>Election</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidates as $candidate)
            <tr>
                <td>{{ $candidate->name }}</td>
                <td>{{ $candidate->party }}</td>
                <td>{{ $candidate->election ? $candidate->election->title : 'No Election Assigned' }}</td>
                <td>
                    <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" class="d-inline">
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
