<!-- view/user/aianalyisvealuation.blade.php -->
<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Card để nhập văn bản -->
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fas fa-pen-alt me-2"></i> Text Analysis and Evaluation</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('ask-openai') }}" method="POST" id="textAnalysisForm">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label"><i class="fas fa-edit me-1"></i> Enter your text</label>
                            <textarea class="form-control" id="message" name="message" rows="10" required></textarea>
                        </div>

                        <!-- Dropdown chọn ngôn ngữ -->
                        <div class="mb-3">
                            <label for="language" class="form-label"><i class="fas fa-language me-1"></i> Select Language</label>
                            <select class="form-control" id="language" name="language" required>
                                <option value="en">English</option>
                                <option value="vi">Vietnamese</option>
                                <!-- Thêm các ngôn ngữ khác nếu cần -->
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100" id="submitButton">
                            <i class="fas fa-paper-plane me-2"></i> Analyze and Evaluate
                        </button>
                    </form>
                </div>
            </div>
            <!-- Hiển thị thời gian phản hồi -->
            <div id="responseTimeContainer" class="mt-3"></div>

            <!-- Hiển thị kết quả nếu có -->
            <div id="resultContainer"></div>

            <!-- Hiển thị lỗi nếu có -->
            <div id="errorContainer"></div>


        </div>
    </div>

    <script>
        // Thêm chức năng loading cho nút
        const form = document.getElementById('textAnalysisForm');
        const submitButton = document.getElementById('submitButton');
        const responseTimeContainer = document.getElementById('responseTimeContainer');

        form.addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn không cho form submit thông thường
            const formData = new FormData(form);
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Loading for AI analysis and evaluation...'; // Thay đổi nội dung nút
            submitButton.disabled = true; // Vô hiệu hóa nút
            
            // Bắt đầu đo thời gian
            const startTime = performance.now();

            // Gửi yêu cầu AJAX
            fetch("{{ route('ask-openai') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest' // Để xác định yêu cầu AJAX
                }
            })
            .then(response => response.json())
            .then(data => {
                // Hiển thị kết quả
                if (data.success) {
                    const resultHtml = `
                        <div class="card shadow-sm mt-4">
                            <div class="card-header bg-info text-white">
                                <h5><i class="fas fa-chart-line me-2"></i> Analysis Result</h5>
                            </div>
                            <div class="card-body">
                                <p>${data.answer}</p>
                            </div>
                        </div>
                        <div class="card shadow-sm mt-4">
                            <div class="card-header bg-warning text-dark">
                                <h5><i class="fas fa-star me-2"></i> Evaluation Result</h5>
                            </div>
                            <div class="card-body">
                                <p>${data.evaluation}</p>
                            </div>
                        </div>
                    `;
                    document.getElementById('resultContainer').innerHTML = resultHtml;

                    // Tính thời gian phản hồi
                    const endTime = performance.now();
                    const responseTime = ((endTime - startTime) / 1000).toFixed(2); // Thời gian phản hồi trong giây
                    responseTimeContainer.innerHTML = `<div class="alert alert-success"><strong>Response Time:</strong> ${responseTime} seconds</div>`;
                } else {
                    document.getElementById('errorContainer').innerHTML = `<div class="alert alert-danger mt-4"><i class="fas fa-exclamation-circle me-2"></i> ${data.error}</div>`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('errorContainer').innerHTML = `<div class="alert alert-danger mt-4"><i class="fas fa-exclamation-circle me-2"></i> An error occurred. Please try again later.</div>`;
            })
            .finally(() => {
                submitButton.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Analyze and Evaluate'; // Khôi phục nội dung nút
                submitButton.disabled = false; // Bật lại nút
            });
        });
    </script>
</x-app-layout>
