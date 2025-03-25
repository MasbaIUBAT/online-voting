@extends('layouts.app')

@section('content')
<div class="container py-4">
    <!-- Page Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">📝 Add New Candidate</h2>
    </div>

    <!-- Candidate Form -->
    <form action="{{ route('candidates.store') }}" method="POST">
        @csrf

        <!-- Election Selection -->
        <div class="mb-4">
            <label for="election_id" class="form-label">Select Election</label>
            <select class="form-control shadow-sm" name="election_id" required>
                <option value="" disabled selected>Select an Election</option>
                @foreach($elections as $election)
                    <option value="{{ $election->id }}">{{ $election->title }}</option>
                @endforeach
            </select>
        </div>

        <!-- Candidate Name -->
        <div class="mb-4">
            <label for="name" class="form-label">Candidate Name</label>
            <input type="text" class="form-control shadow-sm" name="name" required placeholder="Enter candidate name">
        </div>

        <!-- Party Name -->
        <div class="mb-4">
            <label for="party" class="form-label">Party Name</label>
            <input type="text" class="form-control shadow-sm" name="party" required placeholder="Enter party name">
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control shadow-sm" name="description" rows="4" placeholder="Enter a brief description of the candidate"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="btn btn-success btn-lg shadow-lg">Save Candidate</button>
        </div>
    </form>
</div>
@endsection
