<x-app-layout>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5><i class="fas fa-history me-2"></i> Analysis and Evaluation History</h5>
        </div>
        <div class="card-body">
            <table id="historyTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Content</th>
                        <th>Type</th>
                        <th>Timestamp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                        <tr>
                            <td>{{ $history->id }}</td>
                            <td>
                                {{ Str::limit($history->text_content, 100) }}...
                            </td>
                            <td>{{ $history->type_of_analysis }}</td>
                            <td>{{ $history->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <button class="btn btn-info btn-sm view-analysis" data-id="{{ $history->id }}">
                                    <i class="fas fa-search"></i>
                                </button>
                                <button class="btn btn-danger btn-sm delete-history" data-id="{{ $history->id }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="analysisModal" tabindex="-1" aria-labelledby="analysisModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-info text-white">
                    <h5 class="modal-title" id="analysisModalLabel">Analysis Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Content to Analyze:</h5>
                    <p id="contentToAnalyze" class="border p-2 rounded bg-light"></p>
                    <h5>Analysis Response:</h5>
                    <p id="analysisResponse" class="border p-2 rounded bg-light"></p>
                    <h5>Evaluation Response:</h5>
                    <p id="evaluationResponse" class="border p-2 rounded bg-light"></p>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        // Thêm token CSRF vào tất cả các yêu cầu AJAX
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    
        // Initialize DataTable
        $('#historyTable').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    
        // Xem phân tích
        $(document).on('click', '.view-analysis', function() {
            var id = $(this).data('id');
    
            // Gửi yêu cầu AJAX để lấy dữ liệu phân tích
            $.ajax({
                url: '/analysis-evaluation-history/' + id,
                method: 'GET',
                success: function(data) {
                    // Cập nhật nội dung modal
                    $('#contentToAnalyze').html(data.content);
                    $('#analysisResponse').html(data.analysis);
                    $('#evaluationResponse').html(data.evaluation);
                    
                    // Hiện modal
                    $('#analysisModal').modal('show');
                },
                error: function(xhr) {
                    // Sử dụng SweetAlert để thông báo lỗi
                    swal("Error", xhr.responseJSON.error || "An error occurred", "error");
                }
            });
        });
    
        // Xóa dữ liệu
        $(document).on('click', '.delete-history', function() {
            var id = $(this).data('id');
            
            // Sử dụng SweetAlert để xác nhận xóa
            swal({
                title: "Are you sure to delete history "+ id +"?",
                text: "You will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        url: '/analysis-evaluation-history/' + id,
                        method: 'DELETE',
                        success: function(data) {
                            // Sử dụng SweetAlert để thông báo thành công
                            swal("Deleted successfully!", {
                                icon: "success",
                            }).then(() => {
                                location.reload(); // Tải lại trang để cập nhật bảng
                            });
                        },
                        error: function(xhr) {
                            // Sử dụng SweetAlert để thông báo lỗi
                            swal("Error", xhr.responseJSON.error || "An error occurred", "error");
                        }
                    });
                } 
            });
        });
    });
    </script>
    