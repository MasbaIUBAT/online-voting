<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results Report</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f4f7fb;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            font-size: 2.5rem;
            color: #5d8bf4;
            margin-bottom: 40px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            font-size: 1rem;
        }

        th {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        td {
            border: 1px solid #ddd;
        }

        .rank {
            font-weight: bold;
            color: #4CAF50;
        }

        .candidate-name {
            color: #555;
        }

        .party {
            color: #FF5722;
        }

        .votes {
            color: #2196F3;
        }

    </style>
</head>
<body>

    <h2>Election Results for {{ $latestElection->title }}</h2>

    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Candidate</th>
                <th>Party</th>
                <th>Total Votes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($candidates->sortByDesc('votes_count')->values() as $index => $candidate)
                <tr>
                    <td class="rank">{{ $index + 1 }}</td>
                    <td class="candidate-name">{{ $candidate->name }}</td>
                    <td class="party">{{ $candidate->party }}</td>
                    <td class="votes">{{ $candidate->votes_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
