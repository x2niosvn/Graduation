<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordifyAI - AI Text Analysis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{ asset('css/homepage.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/wordifyai.png') }}" alt="WordifyAI logo" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                </ul>
                <div>
                    <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 mb-4">AI Text Analysis Chatbot Helps You Gain Deeper Insights into Language Data</h1>
            <a href="#" class="btn btn-info btn-lg">Use Now</a>
        </div>
    </section>

    <section class="features py-5">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <img src="{{ asset('img/save_time.png') }}" alt="Save time analyzing data" class="feature-icon">
                    <h3>Save time analyzing data</h3>
                    <p>Automatically analyze text in seconds, saving you time and increasing productivity.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('img/communication.png') }}" alt="Better understanding of customer feedback" class="feature-icon">
                    <h3>Better understanding of customer feedback</h3>
                    <p>Quickly capture customer sentiment and opinions from feedback to make appropriate strategies.</p>
                </div>
                <div class="col-md-4">
                    <img src="{{ asset('img/flexible.png') }}" alt="Easy integration with existing systems" class="feature-icon">
                    <h3>Easy integration with existing systems</h3>
                    <p>Seamlessly integrate with existing tools and platforms, helping you exploit data without changing processes.</p>
                </div>
            </div>
        </div>
    </section>
    
    <footer class="text-dark py-4 mt-5" style="background: #f3f3f3">
        <div class="container text-center">
            <!-- Social Media Links -->
            <div class="mb-3">
                <a href="#" class="text-dark mx-2"><i class="fab fa-facebook fa-2x"></i></a>
                <a href="#" class="text-dark mx-2"><i class="fab fa-twitter fa-2x"></i></a>
                <a href="#" class="text-dark mx-2"><i class="fab fa-linkedin fa-2x"></i></a>
                <a href="#" class="text-dark mx-2"><i class="fab fa-instagram fa-2x"></i></a>
            </div>

    
            <!-- Copyright -->
            <p class="mb-0">© 2024 WordifyAI. All rights reserved.</p>
        </div>
    </footer>
    
    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>