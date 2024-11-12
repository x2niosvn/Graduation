<x-admin-layout>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0"><i class="fas fa-list-alt"></i> Manage Suggestions</h5>
            </div>
            <div class="container">

                @if(session('success'))
                    <div class="alert alert-success text-center mt-3">{{ session('success') }}</div>
                @endif

                <table id="suggestionsTable" class="table table-striped mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Suggestion</th>
                            <th>Status</th>
                            <th>Admin Feedback</th>
                            <th>Submitted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suggestions as $suggestion)
                            <tr>
                                <td>{{ $suggestion->title }}</td>
                                <td>{{ Str::limit($suggestion->suggestion_text, 50) }}</td>
                                <td>
                                    <span class="badge {{ $suggestion->status == 'approved' ? 'bg-success' : ($suggestion->status == 'pending' ? 'bg-warning text-dark' : 'bg-danger') }}">
                                        {{ ucfirst($suggestion->status) }}
                                    </span>
                                </td>
                                <td>{{ $suggestion->admin_feedback ?? 'N/A' }}</td>
                                <td>{{ $suggestion->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.suggestions.show', $suggestion->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i> Review
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <!-- DataTables Script -->
        <script>
            $(document).ready(function() {
                $('#suggestionsTable').DataTable({
                    "paging": true,  // DataTable sẽ tự động phân trang
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": false
                });
            });
        </script>
    </div>
</x-admin-layout>
