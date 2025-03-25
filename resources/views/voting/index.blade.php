@extends('layouts.app')

@section('content')
<body style="position: relative; width: 100%; height: 100%; background: url('{{ asset('images/Image3.jpeg') }}') no-repeat center center / cover;">
<div class="container mt-5">
    <h2 class="text-center fw-bold bg-light mb-4">🗳️ Vote for Your Candidate</h2>

    @if(session('success'))
        <div class="alert alert-success text-center fw-bold shadow-sm">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger text-center fw-bold shadow-sm">{{ session('error') }}</div>
    @endif

    <div class="row justify-content-center">
        @foreach($candidates as $candidate)
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 rounded-4 text-center">
                    <div class="card-header text-white py-3"
                        style="background: linear-gradient(135deg, #007bff, #004080);">
                        <h4 class="fw-bold mb-1">{{ $candidate->name }}</h4>
                        <p class="mb-0" style="font-size: 14px;">🏛️ {{ $candidate->party }}</p>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('vote.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="candidate_id" value="{{ $candidate->id }}">
                            <button type="submit" class="btn btn-lg btn-success fw-bold px-4 py-2 shadow-sm">
                                ✅ Vote Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
@endsection
