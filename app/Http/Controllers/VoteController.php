<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vote;
use App\Models\Candidate;
use App\Models\Election;

class VoteController extends Controller
{
    public function index()
    {
        // Get the latest election
        $latestElection = Election::latest()->first();

        // Check if there is any running election
        if (!$latestElection) {
            return redirect()->back()->with('error', 'No running election found.');
        }

        // Fetch candidates for the latest election
        $candidates = Candidate::where('election_id', $latestElection->id)->get();

        return view('voting.index', compact('candidates', 'latestElection'));
    }


    public function result()
    {
        // Get the latest election
        $latestElection = Election::latest()->first();

        // Check if there is any election available
        if (!$latestElection) {
            // No election data found, handle accordingly
            return request()->expectsJson()
                ? response()->json(['message' => 'No election data found.'], 404)
                : view('votes.results', ['candidates' => collect(), 'message' => 'No election data found.']);
        }

        // Get candidates associated with the latest election and their vote count
        $candidates = Candidate::where('election_id', $latestElection->id)
            ->withCount('votes')  // Automatically counts the votes for each candidate
            ->orderByDesc('votes_count')  // Order candidates by vote count, highest first
            ->get();

        // If the request expects JSON, return the candidates in JSON format
        if (request()->expectsJson()) {
            return response()->json([
                'candidates' => $candidates->map(function ($candidate) {
                    return [
                        'id' => $candidate->id,
                        'name' => $candidate->name,
                        'votes_count' => $candidate->votes_count,
                    ];
                })
            ]);
        }

        // If it's a standard request (view), return the results page with the candidates
        return view('votes.results', compact('candidates', 'latestElection'));
    }



    public function store(Request $request)
    {
        $user = Auth::user();

        // Fetch the latest election
        $latestElection = Election::latest()->first();

        // If no election exists, prevent voting
        if (!$latestElection) {
            return redirect()->route('vote.index')->with('error', 'No active election available for voting.');
        }

        // Check if the selected candidate belongs to the latest election
        $candidate = Candidate::where('id', $request->candidate_id)
                            ->where('election_id', $latestElection->id)
                            ->first();

        if (!$candidate) {
            return redirect()->route('vote.index')->with('error', 'Invalid candidate selection for the current election.');
        }

        // Check if the user has already voted in the latest election
        $alreadyVoted = Vote::where('user_id', $user->id)
                            ->whereHas('candidate', function ($query) use ($latestElection) {
                                $query->where('election_id', $latestElection->id);
                            })
                            ->exists();

        if ($alreadyVoted) {
            return redirect()->route('vote.index')->with('error', 'You have already voted in this election!');
        }

        // Store the vote for the latest election candidate
        Vote::create([
            'user_id' => $user->id,
            'candidate_id' => $request->candidate_id,
            'voted_at' => now(),
        ]);

        return redirect()->route('vote.index')->with('success', 'Vote submitted successfully!');
    }




}

