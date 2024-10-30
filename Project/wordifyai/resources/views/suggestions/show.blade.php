<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-info-circle text-primary"></i> Suggestion Details</h4>
                <p><strong>Title:</strong> {{ $suggestion->title }}</p>
                <p><strong>Suggestion Text:</strong> {{ $suggestion->suggestion_text }}</p>
                <p><strong>Status:</strong> 
                    @if($suggestion->status == 'approved')
                        <span class="badge bg-success">Approved</span>
                    @elseif($suggestion->status == 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @else
                        <span class="badge bg-danger">Rejected</span>
                    @endif
                </p>
                <p><strong>Admin Feedback:</strong> {{ $suggestion->admin_feedback ?? 'N/A' }}</p>
                <p><strong>Submitted At:</strong> {{ $suggestion->created_at->format('d/m/Y H:i') }}</p>
                <a href="{{ route('suggestions.create') }}" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
</x-app-layout>
