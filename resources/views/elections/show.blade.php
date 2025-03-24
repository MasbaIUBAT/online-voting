@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Election Details</h2>

    <div class="card">
        <div class="card-body">
            <h4>{{ $election->title }}</h4>
            <p><strong>Start Date:</strong> {{ $election->start_date }}</p>
            <p><strong>End Date:</strong> {{ $election->end_date }}</p>
        </div>
    </div>

    <h3 class="mt-4">Candidates</h3>
    @if($election->candidates->count() > 0)
        <table class="table table-bordered mt-3">
            <thead>
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
    @else
        <p>No candidates added yet.</p>
    @endif
</div>
@endsection
