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
            const candidates = @json($candidates->pluck('name'));
            const votes = @json($candidates->pluck('votes_count'));

            const totalVotes = votes.reduce((sum, value) => sum + value, 0);
            const votePercentages = votes.map(vote => totalVotes ? ((vote / totalVotes) * 100).toFixed(2) : 0);

            const colors = ['#C70039', '#000080', '#808000','#7d3c98', '#229954','#FFBF00'];

            new Chart(ctx, {
                type: 'doughnut',
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
                        }
                    }
                }
            });
        });
    </script>
</div>
</body>
@endsection
