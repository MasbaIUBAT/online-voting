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
    // Generate PDF Report
    public function generatePDF()
    {
        $candidates = Candidate::withCount('votes')->get();
        $election = Election::first();
        $pdf = PDF::loadView('reports.votes_pdf', compact('candidates','election'));
        return $pdf->download('election_results.pdf');
    }

    // Export Excel Report
    public function exportExcel()
    {
        return Excel::download(new VoteExport, 'election_results.xlsx');
    }
}

