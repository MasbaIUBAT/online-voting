@extends('layouts.app')

@section('title', 'Voter Dashboard')

@section('content')
<div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
        Voter Dashboard
    </div>
    <div class="card-body">
        <p>Welcome, Voter! Cast your vote now.</p>
        <a href="/vote" class="btn btn-primary">Vote Now</a>
    </div>
</div>
@endsection
