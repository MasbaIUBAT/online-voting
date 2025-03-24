@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Create Election</h2>

    <form action="{{ route('elections.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Election Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" class="form-control" name="start_date" required>
        </div>

        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" class="form-control" name="end_date" required>
        </div>

        <button type="submit" class="btn btn-success">Create Election</button>
    </form>
</div>
@endsection
