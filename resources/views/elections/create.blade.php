@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg mx-auto" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h3 class="mb-0">🗳️ Create Election</h3>
        </div>
        <div class="card-body">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('elections.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">📌 Election Title</label>
                    <input type="text" class="form-control shadow-sm" name="title" placeholder="Enter election title" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">📅 Start Date</label>
                    <input type="date" class="form-control shadow-sm" name="start_date" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">⏳ End Date</label>
                    <input type="date" class="form-control shadow-sm" name="end_date" required>
                </div>

                <button type="submit" class="btn btn-success w-100 shadow">
                    🚀 Create Election
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
