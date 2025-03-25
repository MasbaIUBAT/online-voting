@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg mx-auto" style="max-width: 600px;">
        <div class="card-header bg-warning text-dark text-center">
            <h3 class="mb-0">✏️ Edit Election</h3>
        </div>
        <div class="card-body">
            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
                    ✅ {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <form action="{{ route('elections.update', $election->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">📌 Election Title</label>
                    <input type="text" name="title" id="title" class="form-control shadow-sm" value="{{ $election->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="start_date" class="form-label fw-bold">📅 Start Date</label>
                    <input type="date" name="start_date" id="start_date" class="form-control shadow-sm" value="{{ $election->start_date }}" required>
                </div>

                <div class="mb-3">
                    <label for="end_date" class="form-label fw-bold">⏳ End Date</label>
                    <input type="date" name="end_date" id="end_date" class="form-control shadow-sm" value="{{ $election->end_date }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('elections.index') }}" class="btn btn-secondary shadow">
                        🔙 Cancel
                    </a>
                    <button type="submit" class="btn btn-warning shadow">
                        ✅ Update Election
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
