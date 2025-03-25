@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-primary text-white text-center fw-bold">
                    ➕ Add New User
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-bold">👤 Full Name</label>
                            <input type="text" name="name" class="form-control shadow-sm" placeholder="Enter full name" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">📧 Email Address</label>
                            <input type="email" name="email" class="form-control shadow-sm" placeholder="Enter email address" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">🔒 Password</label>
                            <input type="password" name="password" class="form-control shadow-sm" placeholder="Enter a secure password" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 shadow fw-bold">
                            ✅ Create User
                        </button>
                    </form>
                </div>
            </div>

            {{-- Back Button --}}
            <div class="text-center mt-3">
                <a href="{{ route('admin.index') }}" class="btn btn-outline-secondary shadow">
                    🔙 Back to Users
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
