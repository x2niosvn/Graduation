<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WordifyAI - AI Text Analysis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background: #e0f7fa;
        }

        /* Navbar */
        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #3518b9;
        }
        .navbar .navbar-brand, .navbar .nav-link, .navbar .btn {
            color: #fff !important;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(to right, #0779cf, #50b9f1);
            color: white;
            padding: 80px 0;
            text-align: center;
        }
        .hero-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
        .hero-section p {
            font-size: 1.2rem;
            margin-top: 20px;
        }
        .hero-section .btn {
            font-size: 1.2rem;
            padding: 10px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
            background: #012ec0;
            color: white;
        }
        .hero-section .btn:hover {
            transform: scale(1.05);
            background: #155f81;
        }

        /* Features Section */
        .features {
            background: #fff;
            padding: 60px 0;
        }
        .feature-box {
            background: #e0f7fa;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: translateY(-10px);
        }
        .feature-icon {
            font-size: 3rem;
            color: #088fdd;
            margin-bottom: 15px;
        }
        .feature-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #333;
        }

        /* Footer */
        footer {
            background: #1484da;
            color: #ccc;
            padding: 40px 0;
            text-align: center;
        }
        footer a {
            color: #ccc;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        footer a:hover {
            color: #0288d1;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-robot fa-lg me-2" style="color: #fff;"></i>WordifyAI
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
                    @if (Auth::check())
                        <a href="{{ route('dashboard') }}" class="btn btn-primary me-2">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-light">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section" data-aos="fade-up">
        <div class="container">
            <h1>AI Text Analysis Chatbot for Deeper Insights</h1>
            <p>Unlock the power of AI to understand text, enhance feedback, and drive decisions.</p>
            <a href="{{ route('text-analysis-evaluation-guest') }}" class="btn btn-info btn-lg mt-4">Try Text Analysis as a Guest</a>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features py-5" data-aos="fade-up">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="feature-box" data-aos="zoom-in">
                        <i class="fas fa-clock feature-icon"></i>
                        <h3 class="feature-title">Save Time</h3>
                        <p>Analyze text instantly and increase productivity.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box" data-aos="zoom-in" data-aos-delay="100">
                        <i class="fas fa-comments feature-icon"></i>
                        <h3 class="feature-title">Understand Feedback</h3>
                        <p>Quickly capture customer sentiment to create effective strategies.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-box" data-aos="zoom-in" data-aos-delay="200">
                        <i class="fas fa-cogs feature-icon"></i>
                        <h3 class="feature-title">Easy Integration</h3>
                        <p>Integrate seamlessly without altering existing workflows.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="mb-4">
                <a href="#" class="me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="me-3"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
            <p>© 2024 WordifyAI. All rights reserved.</p>
        </div>
    </footer>

    <!-- JavaScript and Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            easing: 'ease-in-out',
        });
    </script>
</body>
</html>
