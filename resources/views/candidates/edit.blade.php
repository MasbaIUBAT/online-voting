@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Edit Candidate</h2>

    <form action="{{ route('candidates.update', $candidate->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="election_id" class="form-label">Select Election</label>
            <select class="form-control" name="election_id" required>
                @foreach($elections as $election)
                    <option value="{{ $election->id }}" {{ $election->id == $candidate->election_id ? 'selected' : '' }}>{{ $election->title }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Candidate Name</label>
            <input type="text" class="form-control" name="name" value="{{ $candidate->name }}" required>
        </div>

        <div class="mb-3">
            <label for="party" class="form-label">Party Name</label>
            <input type="text" class="form-control" name="party" value="{{ $candidate->party }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
