<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Candidate;
use App\Models\Vote;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::all();
        return view('elections.index', compact('elections'));
    }

    public function create()
    {
        return view('elections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Delete all votes, candidates, and previous elections
        Vote::query()->delete();
        Candidate::query()->delete(); // Delete all candidates related to previous elections
        Election::query()->delete(); // Delete all previous elections

        // Create a new election
        Election::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('elections.index')->with('success', 'Election and previous data cleared successfully!');
    }



    public function show($id)
    {
        $election = Election::with('candidates')->findOrFail($id);
        return view('elections.show', compact('election'));
    }

    public function edit(Election $election)
    {
        return view('elections.edit', compact('election'));
    }

    public function update(Request $request, Election $election)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $election->update([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('elections.index')->with('success', 'Election updated successfully.');
    }

    public function destroy($id)
    {
        $election = Election::findOrFail($id);

        // Delete all votes related to the candidates of this election
        Vote::whereIn('candidate_id', Candidate::where('election_id', $id)->pluck('id'))->delete();

        // Delete all candidates associated with the election
        Candidate::where('election_id', $id)->delete();

        // Finally, delete the election
        $election->delete();

        return redirect()->route('elections.index')->with('success', 'Election and related data deleted successfully!');
    }
}

