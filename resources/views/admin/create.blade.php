@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New User</h2>

    <form action="{{ route('admin.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create User</button>
    </form>
</div>
@endsection
