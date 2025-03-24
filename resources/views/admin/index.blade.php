@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Admin Dashboard - Manage Users</h2>

    <a href="{{ route('admin.create') }}" class="btn btn-success mb-3">Add New User</a>
    <a href="{{ route('elections.index') }}" class="btn btn-success mb-3">Elections</a>
    <a href="{{ route('candidates.index') }}" class="btn btn-success mb-3">Candidates</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <form action="{{ route('admin.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
