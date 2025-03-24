@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="text-center">
    <h1>Welcome to the Online Voting System</h1>
    <p>Vote for your favorite candidates securely!</p>
    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
    <a href="{{ route('register') }}" class="btn btn-success">Register</a>
</div>
@endsection
