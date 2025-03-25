<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Vote;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin'); // Protect routes
    }

    public function index()
    {
        $users = User::where('role', 'voter')->get();
        $candidates = Candidate::withCount('votes')->get();
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


