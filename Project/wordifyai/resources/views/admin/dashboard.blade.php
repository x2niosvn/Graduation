<x-admin-layout>
    <div class="container mt-4">
        
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex align-items-center">
                <i class="fas fa-cog me-2"></i>
                <h4 class="mb-0">Admin Dashboard</h4>
            </div>
            <div class="card-body">

            <div class="row">

<!-- Users Section -->
<div class="col-12 mb-3">
    <h3 class="text-primary">Users</h3>
</div>
<div class="col-md-6">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-users fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">Total Users</h5>
                <p class="card-text fs-2 fw-bold text-primary mb-0">{{ $userCount }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Analysis Section -->
<div class="col-12 mb-3">
    <h3 class="text-warning">Analysis</h3>
</div>
<div class="col-md-4">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-file-alt fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">Total Analysis</h5>
                <p class="card-text fs-2 fw-bold text-warning mb-0">{{ $totalAnalysis }}</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-check-circle fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">Completed Analysis</h5>
                <p class="card-text fs-2 fw-bold text-info mb-0">{{ $completedAnalysis }}</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-danger rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-times-circle fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">Incomplete Analysis</h5>
                <p class="card-text fs-2 fw-bold text-danger mb-0">{{ $incompleteAnalysis }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Evaluations Section -->
<div class="col-12 mb-3">
    <h3 class="text-success">Evaluations</h3>
</div>
<div class="col-md-4">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-star fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">Total Evaluations</h5>
                <p class="card-text fs-2 fw-bold text-warning mb-0">{{ $totalEvaluations }}</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-thumbs-up fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">Completed Evaluations</h5>
                <p class="card-text fs-2 fw-bold text-info mb-0">{{ $completedEvaluations }}</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-4">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-danger rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-thumbs-down fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">Incomplete Evaluations</h5>
                <p class="card-text fs-2 fw-bold text-danger mb-0">{{ $incompleteEvaluations }}</p>
            </div>
        </div>
    </div>
</div>

<!-- Suggestions Section -->
<div class="col-12 mb-3">
    <h3 class="text-info">Suggestions</h3>
</div>
<div class="col-md-6">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-warning rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-star fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">Total Suggestions</h5>
                <p class="card-text fs-2 fw-bold text-warning mb-0">{{ $totalSuggestions }}</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-thumbs-up fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">Pending Suggestions</h5>
                <p class="card-text fs-2 fw-bold text-info mb-0">{{ $totalPendingSuggestions }}</p>
            </div>
        </div>
    </div>
</div>

<!-- API Section -->
<div class="col-12 mb-3">
    <h3 class="text-danger">API Status</h3>
</div>
<div class="col-md-6">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-wallet fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">API Balance</h5>
                <p class="card-text fs-2 fw-bold text-info mb-0">{{ $balance_full }}</p>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card shadow-lg mb-4 border-0">
        <div class="card-body d-flex align-items-center bg-light rounded">
            <div class="icon-container text-white bg-danger rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 60px; height: 60px;">
                <i class="fas fa-chart-line fa-lg"></i>
            </div>
            <div>
                <h5 class="card-title text-muted mb-1">API Used</h5>
                <p class="card-text fs-2 fw-bold text-danger mb-0">{{ $balance_used }}</p>
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
