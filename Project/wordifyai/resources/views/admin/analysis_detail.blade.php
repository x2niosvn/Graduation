<x-admin-layout>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex align-items-center">
                <i class="fas fa-info-circle me-2"></i>
                <h4 class="mb-0">Analysis Details</h4>
            </div>
            <div class="card-body">
                
                <!-- Content Section -->
                <div class="mb-4">
                    <h5 class="text-secondary">
                        <i class="fas fa-align-left me-2"></i> Content
                    </h5>
                    <p class="ps-3">{{ $analysis->text_content }}</p>
                </div>

                <!-- Analysis Result Section -->
                <div class="mb-4">
                    <h5 class="text-secondary">
                        <i class="fas fa-chart-bar me-2"></i> Analysis Result
                    </h5>
                    <div class="ps-3">{!! $analysis->analysis_result !!}</div>
                </div>

                <!-- Timestamp Section -->
                <div class="mb-4">
                    <h5 class="text-secondary">
                        <i class="fas fa-clock me-2"></i> Timestamp
                    </h5>
                    <p class="ps-3">{{ $analysis->created_at->format('d/m/Y H:i') }}</p>
                </div>

                <!-- Back Button -->
                <a href="{{ route('admin.analysisHistory') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Back to History
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
