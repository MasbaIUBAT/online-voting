<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Results Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Election Results for {{ $election->title }}</h2>
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
            @foreach($candidates as $index => $candidate)
                <tr>
                    <td>{{ $index + 1 }}</td>  <!-- Display rank -->
                    <td>{{ $candidate->name }}</td>
                    <td>{{ $candidate->party }}</td>
                    <td>{{ $candidate->votes_count }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
