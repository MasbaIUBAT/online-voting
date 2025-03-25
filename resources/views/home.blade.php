@extends('layouts.app')

@section('title', 'Home')

@section('content')
<body style="position: relative; width: 100%; height: 100%; background: url('{{ asset('images/Image2.jpeg') }}') no-repeat center center / cover;">
<div class="hero-section text-center py-5" style="background: linear-gradient(135deg, #ff7e5f, #feb47b);">
    <div class="container">
        <h1 class="display-3 text-white mb-4">Welcome to the Online Voting System</h1>
        <p class="lead text-white mb-4">Vote for your favorite candidates securely and efficiently!</p>

        <div class="action-buttons">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-3">Login</a>
            <a href="{{ route('register') }}" class="btn btn-success btn-lg mx-3">Register</a>
        </div>
    </div>
</div>

<div class="container text-center my-5">
    <h2 class="text-primary mb-4">How It Works</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title text-primary">Step 1: Register</h5>
                    <p class="card-text">Create an account to join the voting system and participate in elections.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title text-primary">Step 2: Vote</h5>
                    <p class="card-text">Choose your favorite candidates and cast your vote securely.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <h5 class="card-title text-primary">Step 3: View Results</h5>
                    <p class="card-text">Once voting is over, view the results and see who won!</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
