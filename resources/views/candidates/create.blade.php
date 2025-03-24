@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Add Candidate</h2>

    <form action="{{ route('candidates.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="election_id" class="form-label">Select Election</label>
            <select class="form-control" name="election_id" required>
                @foreach($elections as $election)
                    <option value="{{ $election->id }}">{{ $election->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Candidate Name</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label for="party" class="form-label">Party Name</label>
            <input type="text" class="form-control" name="party" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
