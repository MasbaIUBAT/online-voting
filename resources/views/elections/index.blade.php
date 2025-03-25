@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">🗳️ Elections</h2>
        <a href="{{ route('elections.create') }}" class="btn btn-success shadow">
            ➕ Create New Election
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-lg">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>📌 Title</th>
                            <th>📅 Start Date</th>
                            <th>⏳ End Date</th>
                            <th>⚙️ Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($elections as $election)
                        <tr>
                            <td class="fw-bold">{{ $election->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($election->start_date)->format('d M Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($election->end_date)->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('elections.show', $election->id) }}" class="btn btn-primary btn-sm shadow">
                                    👁️ View
                                </a>
                                <a href="{{ route('elections.edit', $election->id) }}" class="btn btn-warning btn-sm shadow">
                                    ✏️ Edit
                                </a>
                                <form action="{{ route('elections.destroy', $election->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm shadow" onclick="return confirm('Are you sure you want to delete this election?')">
                                        🗑️ Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                        @if($elections->isEmpty())
                            <tr>
                                <td colspan="4" class="text-muted text-center">🚫 No elections available.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
