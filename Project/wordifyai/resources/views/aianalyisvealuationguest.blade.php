<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <title>Hello, world!</title>
    <style>
        body {
            background-color: #f7f9fb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #0062cc;
            border-radius: 12px 12px 0 0;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #d1d1d1;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: #0062cc;
            box-shadow: 0 0 5px rgba(0, 98, 204, 0.5);
        }
        .btn-success {
            background-color: #5a47c5;
            border: none;
            transition: background-color 0.3s, box-shadow 0.3s;
        }
        .btn-success:hover {
            background-color: #7b85df;
            box-shadow: 0 4px 12px rgba(0, 98, 204, 0.2);
        }
        .btn-secondary, .btn-info {
            border: none;
        }
        .alert {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
    

  </head>
  <body>




    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">
                        <h5><i class="fas fa-pen-alt me-2"></i> Text Analysis and Evaluation - For Guest</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('guest-analyze-evaluation-text') }}" method="POST" id="textAnalysisForm">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label"><i class="fas fa-edit me-1"></i> Enter your text (Max: 500 word)</label>
                                <textarea class="form-control" id="message" name="message" rows="10" required></textarea>
                            </div>
    

                            <div class="mb-3">
                                <label for="language" class="form-label"><i class="fas fa-language me-1"></i> Select Language</label>
                                <select class="form-control" id="language" name="language" disabled>
                                    <option value="en">English</option>
                                    <option value="vi">Vietnamese</option>
                                </select>
                            </div>
    
                            <div class="mb-3">
                                <label for="analysis_evaluation" class="form-label"><i class="fas fa-cog me-1"></i> Select Type</label>
                                <select class="form-control" id="analysis_evaluation" name="analysis_evaluation" disabled>
                                    <option value="analysis">Analysis</option>
                                    <option value="evaluation">Evaluation</option>
                                </select>
                            </div>
    



                            <button type="submit" class="btn btn-secondary w-100" id="submitButton">
                                <i class="fas fa-paper-plane me-2"></i> Analyze and Evaluate
                            </button>





                        </form>
                    </div>
                </div>
    
                <div id="responseTimeContainer" class="mt-3"></div>
                <div id="resultContainer"></div>
                <div id="errorContainer"></div>
    
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/') }}" class="btn btn-secondary"><i class="fas fa-home"></i> Home</a>
                    <a href="{{ route('login') }}" class="btn btn-primary"><i class="fas fa-sign-in-alt"></i> Login</a>
                </div>
    
            </div>
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

            fetch("{{ route('guest-analyze-evaluation-text') }}", {
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












    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>



