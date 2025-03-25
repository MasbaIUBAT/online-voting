<?php

namespace App\Exports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class VoteExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Candidate::select('candidates.name', 'candidates.party',
                DB::raw('(SELECT COUNT(*) FROM votes WHERE votes.candidate_id = candidates.id) as votes_count'))
            ->orderByDesc('votes_count')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Candidate Name',
            'Party',
            'Total Votes'
        ];
    }
}
