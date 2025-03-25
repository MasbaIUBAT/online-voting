@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container py-4">
    <h2 class="text-center my-4 text-white bg-dark p-3 rounded shadow-lg">
        🏛️ Admin Dashboard
    </h2>

    {{-- Dashboard Stats --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-success shadow-lg rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title">📅 Total Elections</h5>
                    <h3 class="fw-bold">{{ $electionsCount }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-secondary shadow-lg rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title">👤 Total Candidates</h5>
                    <h3 class="fw-bold">{{ $candidates->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow-lg rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title">👥 Total Users</h5>
                    <h3 class="fw-bold">{{ $users->count() }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow-lg rounded-3">
                <div class="card-body text-center">
                    <h5 class="card-title">🗳️ Total Votes</h5>
                    <h3 class="fw-bold">{{ $totalVotes }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation Buttons --}}
    <div class="d-flex justify-content-center gap-3 mb-4">
        <a href="{{ route('admin.create') }}" class="btn btn-outline-success btn-lg shadow fw-bold">
            ➕ Add User
        </a>
        <a href="{{ route('elections.index') }}" class="btn btn-outline-primary btn-lg shadow fw-bold">
            🗳️ Elections
        </a>
        <a href="{{ route('candidates.index') }}" class="btn btn-outline-secondary btn-lg shadow fw-bold">
            👤 Candidates
        </a>
        <a href="{{ route('vote.results') }}" class="btn btn-outline-danger btn-lg shadow fw-bold">
            📊 Results Diagram
        </a>
    </div>

    {{-- Reports & Audit Logs --}}
    <div class="text-center my-4">
        <h3 class="text-primary fw-bold">📊 Generate Reports</h3>
        <a href="{{ route('report.pdf', ['electionId' => $election->id]) }}" class="btn btn-danger mx-2 shadow">
            📄 Download PDF
        </a>
        <a href="{{ route('report.excel', ['electionId' => $election->id]) }}" class="btn btn-success mx-2 shadow">
            📊 Download Excel
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success text-center fw-bold shadow">{{ session('success') }}</div>
    @endif

   {{-- Live Vote Count Section --}}
<h3 class="text-center mb-3 text-dark fw-bold">📡 Live Vote Count</h3>
<div class="table-responsive">
    <table class="table table-hover table-bordered bg-white shadow rounded">
        <thead class="table-dark">
            <tr>
                <th>🏅 Candidate</th>
                <th>📊 Votes</th>
            </tr>
        </thead>
        <tbody id="vote-count">
            @foreach($candidates as $candidate)
                <tr>
                    <td class="fw-bold">{{ $candidate->name }}</td>
                    <td class="fw-bold text-success" id="votes-{{ $candidate->id }}">
                        {{ $candidate->votes_count }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


    {{-- User Management Section --}}
    <h3 class="text-center mt-5 mb-3 text-dark fw-bold">⚙️ Manage Users</h3>
    <div class="table-responsive">
        <table class="table table-hover table-bordered bg-white shadow rounded">
            <thead class="table-primary">
                <tr>
                    <th>👤 Name</th>
                    <th>📧 Email</th>
                    <th>🛠️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="fw-bold">{{ $user->name }}</td>
                    <td class="text-muted">{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('admin.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm shadow" onclick="return confirm('Are you sure?')">
                                ❌ Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Real-Time Vote Count Script --}}
<script>
    setInterval(() => {
        fetch("{{ route('vote.results') }}")
        .then(response => response.json())
        .then(data => {
            data.candidates.forEach(candidate => {
                document.getElementById(`votes-${candidate.id}`).innerText = candidate.votes_count;
            });
        });
    }, 5000); // Refresh every 5 seconds
</script>
@endsection
