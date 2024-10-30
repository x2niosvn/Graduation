<x-app-layout>
    <div class="container mt-4">
        <h2 class="text-center"><i class="fas fa-lightbulb text-primary"></i> Submit Your Suggestion</h2>

        @if(session('success'))
            <div class="alert alert-success text-center mt-3">{{ session('success') }}</div>
        @endif

        <!-- Card for Suggestion Form -->
        <div class="card shadow-sm mt-4">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-edit text-info"></i> Share Your Ideas</h4>
                <form action="{{ route('suggestions.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" id="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="suggestion_text" class="form-label">Suggestion</label>
                        <textarea name="suggestion_text" class="form-control" id="suggestion_text" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100"><i class="fas fa-paper-plane"></i> Submit Suggestion</button>
                </form>
            </div>
        </div>

        <!-- Card for Suggestions History -->
        <div class="card shadow-sm mt-5">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-history text-success"></i> Your Suggestions History</h4>
                <table class="table table-striped mt-3">
                    <thead class="table-light">
                        <tr>
                            <th><i class="fas fa-heading"></i> Title</th>
                            <th><i class="fas fa-comments"></i> Suggestion</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                            <th><i class="fas fa-comment-dots"></i> Admin Feedback</th>
                            <th><i class="fas fa-calendar-alt"></i> Submitted At</th>
                            <th><i class="fas fa-cogs"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suggestions as $suggestion)
                            <tr>
                                <td>{{ $suggestion->title }}</td>
                                <td>{{ Str::limit($suggestion->suggestion_text, 50) }}</td>
                                <td>
                                    @if($suggestion->status == 'approved')
                                        <span class="badge bg-success"><i class="fas fa-check-circle"></i> Approved</span>
                                    @elseif($suggestion->status == 'pending')
                                        <span class="badge bg-warning text-dark"><i class="fas fa-hourglass-half"></i> Pending</span>
                                    @else
                                        <span class="badge bg-danger"><i class="fas fa-times-circle"></i> Rejected</span>
                                    @endif
                                </td>
                                <td>{{ $suggestion->admin_feedback ?? 'N/A' }}</td>
                                <td>{{ $suggestion->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('suggestions.show', $suggestion->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
