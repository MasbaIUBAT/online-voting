<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vote;
use App\Models\Candidate;

class VoteController extends Controller
{
    public function index()
    {
        $candidates = Candidate::all(); // Fetch all candidates
        return view('voting.index', compact('candidates'));
    }

    public function result()
    {
        $candidates = Candidate::withCount('votes')->get();

        if (request()->expectsJson())
        {
            return response()->json(['candidates' => $candidates]);
        }

        return view('votes.results', compact('candidates'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if user has already voted
        if (Vote::where('user_id', $user->id)->exists()) {
            return redirect()->route('vote.index')->with('error', 'You have already voted!');
        }

        // Validate and store the vote
        $request->validate([
            'candidate_id' => 'required|exists:candidates,id',
        ]);

        Vote::create([
            'user_id' => $user->id,
            'candidate_id' => $request->candidate_id,
            'voted_at' => now(),
        ]);

        return redirect()->route('vote.index')->with('success', 'Vote submitted successfully!');
    }
}

