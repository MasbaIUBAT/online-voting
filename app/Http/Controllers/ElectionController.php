<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Election;
use App\Models\Candidate;

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

        Election::create([
            'title' => $request->title,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        return redirect()->route('elections.index')->with('success', 'Election created successfully!');
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
        $election->delete();

        return redirect()->route('elections.index')->with('success', 'Election deleted successfully!');
    }
}

