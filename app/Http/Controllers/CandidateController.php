<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('election')->get();
        return view('candidates.index', compact('candidates'));
    }

    public function create()
    {
        $elections = Election::all();
        return view('candidates.create', compact('elections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'election_id' => 'required|exists:elections,id',
            'name' => 'required|string|max:255',
            'party' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Candidate::create($request->all());
        return redirect()->route('candidates.index')->with('success', 'Candidate added successfully.');
    }

    public function edit(Candidate $candidate)
    {
        $elections = Election::all();
        return view('candidates.edit', compact('candidate', 'elections'));
    }

    public function update(Request $request, Candidate $candidate)
    {
        $request->validate([
            'election_id' => 'required|exists:elections,id',
            'name' => 'required|string|max:255',
            'party' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $candidate->update($request->all());
        return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }

    public function destroy(Candidate $candidate)
    {
        $candidate->delete();
        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully.');
    }
}

