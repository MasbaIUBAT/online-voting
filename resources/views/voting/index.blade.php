@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center my-4">Vote for Your Candidate</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @foreach($candidates as $candidate)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h4>{{ $candidate->name }}</h4>
                        <form action="{{ route('vote.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                            <button type="submit" class="btn btn-primary">Vote</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
