<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div> --}}



    <div class="row">
        <div class="col-md-6 mb-4">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="col-md-6 mb-4">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="row">
            @include('profile.partials.delete-user-form')
    </div>

</x-app-layout>






    
      
    
{{--     
        

        <div class="row">
            <!-- User Profile Section -->
            <div class="col-md-6 mb-4">
                <div class="card" style="background-color: #f8f9fa; color: #343a40; border: 1px solid #0056b3; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);">
                    <div class="container mb-4 mt-4">
                        <h2 class="text-center mb-4" style="color:#0056b3;">Update User Profile</h2>
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
    
    
    


    <script>
        $(document).ready( function () {
    $('#myTable').DataTable();
    } );
    </script> --}}

