@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-dark text-white">
        Admin Dashboard
    </div>
    <div class="card-body">
        <p>Welcome, Admin! Manage elections and users here.</p>
        <a href="#" class="btn btn-primary">Manage Elections</a>
        <a href="#" class="btn btn-success">Manage Users</a>
    </div>
</div>
@endsection
