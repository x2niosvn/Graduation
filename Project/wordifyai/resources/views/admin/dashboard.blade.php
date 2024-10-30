<x-admin-layout>
    <div class="container mt-4">
        
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex align-items-center">
                <i class="fas fa-cog me-2"></i>
                <h4 class="mb-0">Admin Dashboard</h4>
            </div>
            <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4 border-primary">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-users fa-2x text-primary me-3"></i>
                        <div>
                            <h5 class="card-title">Total Users</h5>
                            <p class="card-text fs-3">{{ $userCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4 border-success">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-chart-line fa-2x text-success me-3"></i>
                        <div>
                            <h5 class="card-title">Total Analysis And Evaluation</h5>
                            <p class="card-text fs-3">{{ $totalAnalysisAndEvaluations }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 border-warning">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-file-alt fa-2x text-warning me-3"></i>
                        <div>
                            <h5 class="card-title">Total Analysis</h5>
                            <p class="card-text fs-3">{{ $totalAnalysis }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 border-info">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-check-circle fa-2x text-info me-3"></i>
                        <div>
                            <h5 class="card-title">Completed Analysis</h5>
                            <p class="card-text fs-3">{{ $completedAnalysis }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 border-danger">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-times-circle fa-2x text-danger me-3"></i>
                        <div>
                            <h5 class="card-title">Incomplete Analysis</h5>
                            <p class="card-text fs-3">{{ $incompleteAnalysis }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 border-warning">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-star fa-2x text-warning me-3"></i>
                        <div>
                            <h5 class="card-title">Total Evaluations</h5>
                            <p class="card-text fs-3">{{ $totalEvaluations }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 border-info">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-thumbs-up fa-2x text-info me-3"></i>
                        <div>
                            <h5 class="card-title">Completed Evaluations</h5>
                            <p class="card-text fs-3">{{ $completedEvaluations }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-4 border-danger">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas fa-thumbs-down fa-2x text-danger me-3"></i>
                        <div>
                            <h5 class="card-title">Incomplete Evaluations</h5>
                            <p class="card-text fs-3">{{ $incompleteEvaluations }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biểu đồ -->
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card border-dark">
                    <div class="card-body">
                        <h5 class="card-title">Analysis and Evaluation Summary</h5>
                        <canvas id="summaryChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
            </div>
        </div>


    </div>

    <script>
        // Biểu đồ sử dụng Chart.js
        const ctx = document.getElementById('summaryChart').getContext('2d');
        const summaryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Analysis', 'Completed Analysis', 'Incomplete Analysis', 'Total Evaluations', 'Completed Evaluations', 'Incomplete Evaluations'],
                datasets: [{
                    label: 'Count',
                    data: [{{ $totalAnalysis }}, {{ $completedAnalysis }}, {{ $incompleteAnalysis }}, {{ $totalEvaluations }}, {{ $completedEvaluations }}, {{ $incompleteEvaluations }}],
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</x-admin-layout>
