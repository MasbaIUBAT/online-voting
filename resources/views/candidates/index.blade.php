@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">🗳️ Candidates Management</h2>
    </div>

    <!-- Add Candidate Button -->
    <div class="text-center mb-4">
        <a href="{{ route('candidates.create') }}" class="btn btn-success btn-lg shadow-lg">➕ Add Candidate</a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success text-center">{{ session('success') }}</div>
    @endif

    <!-- Candidates Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered shadow-sm">
            <thead class="table-dark">
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
                        <td class="d-flex justify-content-center">
                            <!-- Edit Button -->
                            <a href="{{ route('candidates.edit', $candidate->id) }}" class="btn btn-warning btn-sm me-2">
                                ✏️ Edit
                            </a>
                            <!-- Delete Button -->
                            <form action="{{ route('candidates.destroy', $candidate->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this candidate?')">
                                    🗑️ Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
