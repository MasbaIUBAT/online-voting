@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Edit Election</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('elections.update', $election->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Election Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $election->title }}" required>
        </div>

        <div class="mb-3">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $election->start_date }}" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">End Date</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $election->end_date }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update Election</button>
        <a href="{{ route('elections.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
