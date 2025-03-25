@extends('layouts.app')

@section('title', 'Register')

@section('content')

<body style="position: relative; width: 100%; height: 100%; background: url('{{ asset('images/Image2.jpeg') }}') no-repeat center center / cover;">
<div class="d-flex justify-content-center align-items-center h-100" >
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header text-white text-center py-4"
                 style="background: linear-gradient(135deg, #28a745, #145a32);">
                <h3 class="fw-bold mb-0">📝 Create an Account</h3>
            </div>
            <div class="card-body p-4">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">👤 Full Name</label>
                        <input type="text" name="name" class="form-control shadow-sm" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">📧 Email</label>
                        <input type="email" name="email" class="form-control shadow-sm" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">🔑 Password</label>
                        <input type="password" name="password" class="form-control shadow-sm" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label fw-bold">🔐 Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control shadow-sm" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 fw-bold py-2 shadow-sm">
                        🚀 Register Now
                    </button>
                </form>
            </div>
            <div class="card-footer text-center py-3">
                <p class="mb-0">Already have an account?
                    <a href="{{ route('login') }}" class="text-primary fw-bold">Login</a>
                </p>
            </div>
        </div>
    </div>
</div>
</body>
@endsection
