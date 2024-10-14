<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile Wireframe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="p&h.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

</head>
<body>



    
    <nav class="navbar navbar-expand-lg navbar-light container" style="border-bottom: 2px solid #000; padding-bottom: 10px;">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/" style="text-decoration: none;">
                <img src="logobtec.png" alt="Logo" width="150px" class="mr-4">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Contact</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    
      
    
    
        
    <div class="container mt-5">
        <div class="row">
            <!-- User Profile Section -->
            <div class="col-md-6 mb-4">
                <div class="card" style="background-color: #f8f9fa; color: #343a40; border: 1px solid #0056b3; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);">
                    <div class="container mb-4 mt-4">
                        <h2 class="text-center mb-4" style="color:#0056b3;">User Profile</h2>
                        <hr style="background-color: #000; height: 2px;">
                        <!-- Profile Picture -->
                        <div class="text-center mb-3">
                            <div class="profile-image mx-auto" style="width: 150px; height: 150px; overflow: hidden;">
                                <img src="avt.jpg" alt="User Profile Picture" class="img-fluid rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                        <!-- Input fields to edit user information -->
                        <div class="mb-3">
                            <label for="name" class="form-label"><strong>Name:</strong></label>
                            <input type="text" class="form-control" id="name" value="Username">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label"><strong>Email:</strong></label>
                            <input type="email" class="form-control" id="email" value="email@example.com">
                        </div>
                        <!-- Confirm Button -->
                        <div class="text-center">
                            <button class="btn btn-success w-100" style="background-color: #0056b3; border-color: #004085;">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Change Password Section -->
            <div class="col-md-6 mb-4">
                <div class="card" style="background-color: #f8f9fa; color: #343a40; border: 1px solid #0056b3; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);">
                    <div class="container mb-4 mt-4">
                        <h2 class="text-center mb-4" style="color:#0056b3;">Change Password</h2>
                        <hr style="background-color: #000; height: 2px;">
                        <!-- Change Password Fields -->
                        <div class="mb-3">
                            <label for="current-password" class="form-label"><strong>Current Password:</strong></label>
                            <input type="password" class="form-control" id="current-password" placeholder="Enter current password">
                        </div>
                        <div class="mb-3">
                            <label for="new-password" class="form-label"><strong>New Password:</strong></label>
                            <input type="password" class="form-control" id="new-password" placeholder="Enter new password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label"><strong>Confirm New Password:</strong></label>
                            <input type="password" class="form-control" id="confirm-password" placeholder="Confirm new password">
                        </div>
                        <!-- Change Password Button -->
                        <div class="text-center">
                            <button class="btn btn-warning w-100" style="background-color: #ffc107; border-color: #e0a800;">Change Password</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Delete Account Section -->
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card" style="background-color: #f8f9fa; color: #343a40; border: 1px solid #0056b3; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);">
                    <div class="container mb-4 mt-4">
                        <h2 class="text-center mb-4" style="color:#0056b3;">Delete Account</h2>
                        <hr style="background-color: #000; height: 2px;">
                        <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
                        <!-- Delete Account Button -->
                        <div class="text-center">
                            <button class="btn btn-danger w-100" style="background-color: #dc3545; border-color: #c82333;">Delete Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- User History Section -->
        <div class="row">
            <div class="col-12">
                <div class="card" style="background-color: #f8f9fa; color: #343a40; border: 1px solid #0056b3; border-radius: 10px; box-shadow: 0  5px 15px rgba(0, 0, 0, 0.5);">
                    <div class="container mt-4 mb-4">
                        <h2 class="text-center mb-4 border" style="color: #b58200;">User History</h2>
                        <hr style="background-color: #000; height: 2px;">
                        <table id="myTable" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Action</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Login Successful</td>
                                    <td>23:00:15 10/10/2024</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Logout Successful</td>
                                    <td>23:50:11 10/10/2024</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    


    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>