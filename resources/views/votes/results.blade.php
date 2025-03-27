@extends('layouts.app')

@section('content')
<body style="position: relative; width: 100%; height: 100%; background: url('{{ asset('images/Image2.jpeg') }}') no-repeat center center / cover;">
<div class="container text-center">
    <h3 class="my-3 text-primary fw-bold">📊 Election Results</h3>

    <div class="card shadow-sm p-3" style="max-width: 400px; margin: auto; background: linear-gradient(135deg, #ff9a9e, #fad0c4); border-radius: 15px;">
        <canvas id="voteChart" style="max-height: 300px;"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('voteChart').getContext('2d');
            let candidates = @json($candidates->pluck('name'));
            let votes = @json($candidates->pluck('votes_count'));

            const totalVotes = votes.reduce((sum, value) => sum + value, 0);
            const votePercentages = votes.map(vote => totalVotes ? ((vote / totalVotes) * 100).toFixed(2) : 0);

            // Define a more vibrant color scheme for the pie chart
            const colors = [
               '#C70039', '#000080', '#808000','#7d3c98', '#229954','#FFBF00', '#F44336', '#FF9800', '#4CAF50', '#2196F3', '#9C27B0', '#FFEB3B', '#FF5722', '#3F51B5', '#8BC34A'
            ];

            // Create the chart with a pie chart type
            let chart = new Chart(ctx, {
                type: 'pie',  // Changed to 'pie' type
                data: {
                    labels: candidates.map((name, index) => `${name} (${votePercentages[index]}%)`),
                    datasets: [{
                        data: votes,
                        backgroundColor: colors,
                        borderColor: '#ffffff',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#333',
                                font: { weight: 'bold' }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    // Add percentage and vote count to tooltip
                                    let percentage = votePercentages[tooltipItem.index];
                                    let voteCount = votes[tooltipItem.index];
                                    return `${candidates[tooltipItem.index]}: ${voteCount} votes (${percentage}%)`;
                                }
                            }
                        }
                    }
                }
            });

            // Function to fetch updated vote counts
            function fetchUpdatedResults() {
                fetch("{{ route('vote.results') }}", {
                    headers: {
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update candidates and votes
                    candidates = data.candidates.map(candidate => candidate.name);
                    votes = data.candidates.map(candidate => candidate.votes_count);

                    // Recalculate vote percentages
                    const totalVotes = votes.reduce((sum, value) => sum + value, 0);
                    const votePercentages = votes.map(vote => totalVotes ? ((vote / totalVotes) * 100).toFixed(2) : 0);

                    // Update chart data
                    chart.data.labels = candidates.map((name, index) => `${name} (${votePercentages[index]}%)`);
                    chart.data.datasets[0].data = votes;

                    // Re-render the chart with updated data
                    chart.update();
                })
                .catch(error => {
                    console.error("Error fetching vote counts:", error);
                });
            }

            // Fetch updated results every 5 seconds
            setInterval(fetchUpdatedResults, 5000); // 5000ms = 5 seconds
        });
    </script>
</div>
</body>
@endsection
