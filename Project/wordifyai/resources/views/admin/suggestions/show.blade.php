<x-app-layout>
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-info-circle text-primary"></i> Suggestion Details</h4>
                <p><strong>Title:</strong> {{ $suggestion->title }}</p>
                <p><strong>Suggestion Text:</strong> {{ $suggestion->suggestion_text }}</p>
                <p><strong>Submitted At:</strong> {{ $suggestion->created_at->format('d/m/Y H:i') }}</p>

                <form action="{{ route('admin.suggestions.update', $suggestion->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="pending" {{ $suggestion->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $suggestion->status == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $suggestion->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="admin_feedback" class="form-label">Admin Feedback</label>
                        <textarea name="admin_feedback" class="form-control" id="admin_feedback" rows="4">{{ $suggestion->admin_feedback }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update Suggestion</button>
                    <a href="{{ route('admin.suggestions.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back</a>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
