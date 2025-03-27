<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Protect routes
    }

    public function index()
    {
        $users = User::where('role', 'voter')->get();

        $latestElection = Election::latest()->first(); // Get the most recent election

        if ($latestElection) {
            // Get candidates for the latest election with vote counts
            $candidates = Candidate::where('election_id', $latestElection->id)  // Ensure it's the latest election
                ->select('candidates.*',
                    DB::raw('(SELECT COUNT(*) FROM votes WHERE votes.candidate_id = candidates.id) as votes_count')
                )
                ->orderByDesc('votes_count')  // Order by votes count
                ->get();
        } else {
            // No election found, return an empty collection or handle it appropriately
            $candidates = collect();
        }

        $electionsCount = Election::count();

        $totalVotes = Vote::count();

        $election = Election::first();

        return view('admin.dashboard', compact('users','candidates','electionsCount','totalVotes','election'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'voter', // Default to voter
        ]);

        return redirect()->route('admin.index')->with('success', 'User Created Successfully!');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index')->with('success', 'User Deleted!');
    }
}


