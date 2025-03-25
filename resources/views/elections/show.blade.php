@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary">📊 Election Details</h2>
    </div>

    <!-- Election Information -->
    <div class="card shadow-lg mb-4">
        <div class="card-body">
            <h4 class="card-title text-success">{{ $election->title }}</h4>
            <p><strong>🗓️ Start Date:</strong> {{ $election->start_date }}</p>
            <p><strong>⏳ End Date:</strong> {{ $election->end_date }}</p>
        </div>
    </div>

    <!-- Candidates Section -->
    <div class="text-center mb-4">
        <h3 class="fw-bold text-info">🏛️ Candidates</h3>
    </div>

    @if($election->candidates->count() > 0)
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>Name</th>
                        <th>Party</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($election->candidates as $candidate)
                    <tr>
                        <td>{{ $candidate->name }}</td>
                        <td>{{ $candidate->party }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-warning text-center">⚠️ No candidates have been added yet.</div>
    @endif

    <!-- Back Button -->
    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('elections.index') }}" class="btn btn-primary shadow-lg">🔙 Back to Elections</a>
    </div>
</div>
@endsection
