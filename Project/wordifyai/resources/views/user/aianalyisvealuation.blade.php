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
                            <label for="file" class="form-label"><i class="fas fa-file-upload me-1"></i> Upload a file (.TXT)</label>
                            <input type="file" class="form-control" id="file" name="file" accept=".txt">
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
                            <label for="ai_model" class="form-label"><i class="fas fa-robot me-1"></i> Select OpenAI Model</label>
                            <select class="form-control" id="ai_model" name="ai_model" required>
                                <option value="1">gpt-3.5-turbo-16k-0613</option>
                                <option value="2">gpt-3.5-turbo-0613</option>
                                <option value="3">gpt-3.5-turbo-1106</option>
                                <option value="4">gpt-3.5-turbo-instruct</option>
                                <option value="5">gpt-3.5-turbo-0125</option>
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
const fileInput = document.getElementById('file');
const messageTextarea = document.getElementById('message');

fileInput.addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            messageTextarea.value = e.target.result;
        };
        reader.readAsText(file);
    }
});

form.addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(form);
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Analyzing...';
    submitButton.disabled = true;

    // Clear previous results
    responseTimeContainer.innerHTML = '';
    resultContainer.innerHTML = '';
    errorContainer.innerHTML = '';

    const startTime = performance.now();

    // Set timeout to change button text after 10 seconds
    const timeoutId = setTimeout(() => {
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Large data, processing may take longer...';
    }, 10000);

    fetch("{{ route('analyze-evaluation-text') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        clearTimeout(timeoutId); // Clear the timeout if response is received before 10 seconds
        if (data.success) {
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
            } else {
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
        clearTimeout(timeoutId); // Clear the timeout if an error occurs
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