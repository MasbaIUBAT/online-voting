@extends('layouts.app')

@section('title', 'Voter Dashboard')

@section('content')
<body style="position: relative; width: 100%; height: 100%; background: url('{{ asset('images/Image1.jpeg') }}') no-repeat center center / cover;">
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
        <div class="card-header bg-gradient text-white text-center py-4"
            style="background: linear-gradient(135deg, #007bff, #6610f2);">
            <h3 class="fw-bold mb-0">🗳️ Voter Dashboard</h3>
        </div>
        <div class="card-body text-center py-5">
            <h4 class="mb-3 text-dark fw-bold">Welcome, Voter! 🎉</h4>
            <p class="text-muted">Your voice matters. Cast your vote now and make a difference!</p>
            <a href="/vote" class="btn btn-lg btn-success fw-bold px-4 py-2 shadow-sm">
                ✅ Vote Now
            </a>
        </div>
    </div>
</div>
</body>
@endsection
