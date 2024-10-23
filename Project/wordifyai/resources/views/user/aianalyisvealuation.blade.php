<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5><i class="fas fa-pen-alt me-2"></i> Text Analysis and Evaluation</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('analyze-evaluation-text') }}" method="POST" id="textAnalysisForm">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label"><i class="fas fa-edit me-1"></i> Enter your text</label>
                            <textarea class="form-control" id="message" name="message" rows="10" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="language" class="form-label"><i class="fas fa-language me-1"></i> Select Language</label>
                            <select class="form-control" id="language" name="language" required>
                                <option value="en">English</option>
                                <option value="vi">Vietnamese</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="analysis_evaluation" class="form-label"><i class="fas fa-cog me-1"></i> Select Type</label>
                            <select class="form-control" id="analysis_evaluation" name="analysis_evaluation" required>
                                <option value="analysis">Analysis</option>
                                <option value="evaluation">Evaluation</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="detail" class="form-label"><i class="fas fa-cogs me-1"></i> Select Analysis Detail <b class="text-danger">(If You Choose Detailed, The System Need Needs More Time)</b></label>
                            <select class="form-control" id="detail" name="detail" required>
                                <option value="simple">Simple</option>
                                <option value="detailed">Detailed</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success w-100" id="submitButton">
                            <i class="fas fa-paper-plane me-2"></i> Analyze and Evaluate
                        </button>
                    </form>
                </div>
            </div>

            <div id="responseTimeContainer" class="mt-3"></div>
            <div id="resultContainer"></div>
            <div id="errorContainer"></div>
        </div>
    </div>

    <script>
        const form = document.getElementById('textAnalysisForm');
        const submitButton = document.getElementById('submitButton');
        const responseTimeContainer = document.getElementById('responseTimeContainer');
        const resultContainer = document.getElementById('resultContainer');
        const errorContainer = document.getElementById('errorContainer');

        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(form);
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
            submitButton.disabled = true;

            const startTime = performance.now();

            fetch("{{ route('analyze-evaluation-text') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {


                    // Hiển thị kết quả phân tích hoặc đánh giá
                    if(data.type == 'analysis'){
                        const analysisHtml = `
                            <div class="card shadow-sm mt-4">
                                <div class="card-header bg-info text-white">
                                    <h5><i class="fas fa-chart-line me-2"></i> Analysis Result</h5>
                                </div>
                                <div class="card-body">
                                    <p>${data.answer}</p>
                                </div>
                            </div>`;
                        resultContainer.innerHTML = analysisHtml;
                    }else{
                        const evaluationHtml = `
                            <div class="card shadow-sm mt-4">
                                <div class="card-header bg-warning text-dark">
                                    <h5><i class="fas fa-star me-2"></i> Evaluation Result</h5>
                                </div>
                                <div class="card-body">
                                    <p>${data.evaluation}</p>
                                </div>
                            </div>`;
                        resultContainer.innerHTML = evaluationHtml;
                    }

                } else {
                    throw new Error(data.error);
                }
            })
            .catch(error => {
                errorContainer.innerHTML = `<div class="alert alert-danger mt-4"><i class="fas fa-exclamation-circle me-2"></i> ${error.message}</div>`;
            })
            .finally(() => {
                submitButton.innerHTML = '<i class="fas fa-paper-plane me-2"></i> Analyze and Evaluate';
                submitButton.disabled = false;

                const endTime = performance.now();
                const responseTime = ((endTime - startTime) / 1000).toFixed(2);
                responseTimeContainer.innerHTML = `<div class="alert alert-success"><strong>Response Time:</strong> ${responseTime} seconds</div>`;
            });
        });
    </script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 12px;
        }
        .form-control {
            border-radius: 8px;
            box-shadow: none;
            transition: border-color 0.3s;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }
        .btn {
            border-radius: 8px;
        }
        .alert {
            border-radius: 8px;
        }
    </style>
</x-app-layout>
