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
                            <td>
                                <span class="badge {{ $history->type_of_analysis == 'text analysis' ? 'bg-success' : 'bg-warning' }}">
                                    {{ ucfirst($history->type_of_analysis) }}
                                </span>
                            </td>
                            <td>{{ $history->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <button class="btn btn-info btn-sm view-analysis" data-id="{{ $history->id }}" data-type="{{ $history->type_of_analysis }}">
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
                    <h5 class="modal-title" id="analysisModalLabel">Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5>Content:</h5>
                    <p id="contentToAnalyze" class="border p-2 rounded bg-light"></p>
                    <div id="typeSpecificContent">
                        <!-- Nơi sẽ hiển thị nội dung phân tích hoặc đánh giá -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="downloadResult" class="btn btn-secondary">Download Result</button>
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

        // Xem chi tiết phân tích hoặc đánh giá
        $(document).on('click', '.view-analysis', function() {
            var id = $(this).data('id');
            var type = $(this).data('type');

            // Gửi yêu cầu AJAX để lấy dữ liệu phân tích/đánh giá
            $.ajax({
                url: '/analysis-evaluation-history/' + id,
                method: 'GET',
                success: function(data) {
                    // Cập nhật nội dung modal
                    $('#contentToAnalyze').html(data.content);

                    // Kiểm tra loại và hiển thị nội dung tương ứng
                    if (type === 'text analysis') {
                        $('#typeSpecificContent').html('<h5>Analysis Response:</h5>' + data.analysis);
                    } else if (type === 'text evaluation') {
                        $('#typeSpecificContent').html('<h5>Evaluation Response:</h5>' + data.evaluation);
                    }

                    // Gán sự kiện tải xuống với nội dung tùy theo loại
                    $('#downloadResult').off('click').on('click', function() {
                        var filename = type.replace(' ', '_') + '_result_' + id + '.txt';
                        var content = type === 'text analysis' ? data.analysis : data.evaluation;
                        
                        // Loại bỏ toàn bộ HTML trong dữ liệu trước khi tải xuống
                        content = removeHtmlTags(content);
                        
                        downloadFile(filename, content);
                    });

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

        // Hàm tải xuống file
        function downloadFile(filename, content) {
            var element = document.createElement('a');
            element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(content));
            element.setAttribute('download', filename);

            element.style.display = 'none';
            document.body.appendChild(element);

            element.click();

            document.body.removeChild(element);
        }

        // Hàm loại bỏ HTML trong nội dung
        function removeHtmlTags(input) {
            var doc = new DOMParser().parseFromString(input, 'text/html');
            return doc.body.textContent || "";
        }
    });
</script>

