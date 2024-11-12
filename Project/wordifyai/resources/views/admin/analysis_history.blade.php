<x-admin-layout>
    <div class="container mt-4">
        <!-- Card for Analysis History -->
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white d-flex align-items-center">
                <i class="fas fa-history me-2"></i>
                <h4 class="mb-0">Analysis & Evaluation History</h4>
            </div>
            <div class="card-body">
                
                <!-- Success Alert -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                <div class="table-responsive">
                <!-- Table for History -->
                <table id="analisysevaluationTable" class="table table-bordered mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Content</th>
                            <th>Result</th> 
                            <th>Type</th>
                            <th>Status</th>
                            <th>Timestamp</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($history as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->user_id }}</td>
                                <td>{{ Str::limit($item->text_content, 30) }}</td>
                                
                                <!-- Conditional Column for Analysis/Evaluation Detail View -->
                                <td>
                                    @if($item->type_of_analysis === 'text analysis')
                                        <a href="{{ route('admin.viewAnalysisDetail', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye me-1"></i> View Analysis
                                        </a>
                                    @elseif($item->type_of_analysis === 'text evaluation')
                                        <a href="{{ route('admin.viewEvaluationDetail', $item->id) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye me-1"></i> View Evaluation
                                        </a>
                                    @endif
                                </td>

                                <td>{{ ucfirst($item->type_of_analysis) }}</td>
                                <td>{{ ucfirst($item->status) }}</td>
                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                
                                <!-- Delete Action -->
                                <td>
                                    <form action="{{ route('admin.deleteAnalysis', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Initialize DataTables
        $(document).ready(function() {
            $('#analisysevaluationTable').DataTable({
                "paging": true,  // DataTable sẽ tự động phân trang
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false
            });
        });
    </script>
</x-admin-layout>
