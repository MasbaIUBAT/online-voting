<?php

namespace App\Exports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VoteExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Candidate::withCount('votes')->get()->map(function ($candidate) {
            return [
                'Candidate Name' => $candidate->name,
                'Party' => $candidate->party,
                'Total Votes' => $candidate->votes_count
            ];
        });
    }

    public function headings(): array
    {
        return ["Candidate Name", "Party", "Total Votes"];
    }
}
