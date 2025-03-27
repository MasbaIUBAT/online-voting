<?php

namespace App\Exports;

use App\Models\Candidate;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VoteExport implements FromCollection, WithHeadings
{
    protected $candidates;
    protected $election;

    public function __construct($candidates, $election)
    {
        $this->candidates = $candidates;
        $this->election = $election;
    }

    public function collection()
    {
        return $this->candidates->map(function ($candidate) {
            return [
                'Candidate Name' => $candidate->name,
                'Party' => $candidate->party,
                'Total Votes' => $candidate->votes_count,
            ];
        });
    }

    public function headings(): array
    {
        return ['Candidate Name', 'Party', 'Total Votes'];
    }
}

