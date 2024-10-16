<section>
    <div class="card shadow-lg" style="background-color: #f8f9fa; color: #343a40; border: 1px solid #0056b3; border-radius: 10px;">
        <div class="card-body">
            <h2 class="text-center mb-4" style="color: #0056b3;">
                <i class="fas fa-user-edit"></i> Update User Profile
            </h2>
            <hr style="background-color: #000; height: 2px;">

            <!-- Role and Creation Date Inputs -->
            <div class="form-group row mb-3">
                <div class="col">
                    <label for="role" class="form-label"><strong><i class="fas fa-user-tag"></i> Role:</strong></label>
                    <input type="text" class="form-control" id="role" name="role" value="{{ Auth::user()->roleName() }}" disabled>
                </div>
                <div class="col">
                    <label for="created_at" class="form-label"><strong><i class="fas fa-calendar-alt"></i> Creation Date:</strong></label>
                    <input type="text" class="form-control" id="created_at" name="created_at" value="{{ $user->created_at->format('h:m:s d/m/Y') }}" disabled>
                </div>
            </div>

            <!-- Input fields to edit user information -->
            <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
                @csrf
                @method('patch')
                
                <!-- Name Input -->
                <div class="form-group mb-3">
                    <label for="name" class="form-label"><strong><i class="fas fa-user"></i> Name:</strong></label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                </div>
    
                <!-- Email Input -->
                <div class="form-group mb-3">
                    <label for="email" class="form-label"><strong><i class="fas fa-envelope"></i> Email:</strong></label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                </div>
    
                <!-- Submit Button -->
                <div class="text-center">
                    <button class="btn btn-primary w-100" type="submit" style="background-color: #0056b3; border-color: #004085;">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
    
                <!-- Success Message -->
                @if (session('status') === 'profile-updated')
                    <div class="text-center mt-3">
                        <p class="text-success">{{ __('Profile updated successfully.') }}</p>
                    </div>
                @endif
            </form>
        </div>
    </div>
</section>
