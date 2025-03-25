@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">✏️ Edit Candidate</h2>
        <p class="text-muted">Update the candidate's details and click "Update" to save the changes.</p>
    </div>

    <!-- Candidate Edit Form -->
    <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Election Selection -->
        <div class="mb-4">
            <label for="election_id" class="form-label">Select Election</label>
            <select class="form-control shadow-sm" name="election_id" required>
                <option value="" disabled selected>Select an Election</option>
                @foreach($elections as $election)
                    <option value="{{ $election->id }}" {{ $election->id == $candidate->election_id ? 'selected' : '' }}>{{ $election->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Candidate Name -->
        <div class="mb-4">
            <label for="name" class="form-label">Candidate Name</label>
            <input type="text" class="form-control shadow-sm" name="name" value="{{ $candidate->name }}" required placeholder="Enter candidate name">
        </div>

        <!-- Party Name -->
        <div class="mb-4">
            <label for="party" class="form-label">Party Name</label>
            <input type="text" class="form-control shadow-sm" name="party" value="{{ $candidate->party }}" required placeholder="Enter party name">
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg shadow-lg">Update Candidate</button>
        </div>
    </form>
</div>
@endsection
