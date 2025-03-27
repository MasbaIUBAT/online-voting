<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Vote;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VoteExport;
use App\Models\Election;

class ReportController extends Controller
{
    public function generatePDF()
    {
        // Get the latest election
        $latestElection = Election::latest()->first();

        // Check if there is any election available
        if (!$latestElection) {
            return redirect()->back()->with('error', 'No election data found.');
        }

        // Fetch candidates for the latest election with vote count
        $candidates = Candidate::where('election_id', $latestElection->id)
            ->withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        // Generate the PDF with the latest election data
        $pdf = PDF::loadView('reports.votes_pdf', compact('candidates', 'latestElection'));

        return $pdf->download('election_results.pdf');
    }


    // Export Excel Report
    public function generateExcel()
    {
        // Get the latest election
        $latestElection = Election::latest()->first();

        // Check if there is any election available
        if (!$latestElection) {
            return redirect()->back()->with('error', 'No election data found.');
        }

        // Fetch candidates for the latest election with vote count
        $candidates = Candidate::where('election_id', $latestElection->id)
            ->withCount('votes')
            ->orderByDesc('votes_count')
            ->get();

        return Excel::download(new VoteExport($candidates, $latestElection), 'election_results.xlsx');
    }

}

