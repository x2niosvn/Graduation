<section>
    <div class="card shadow-lg" style="background-color: #f8f9fa; color: #343a40; border: 1px solid #0056b3; border-radius: 10px;">
        <div class="card-body">
            <h2 class="text-center mb-4" style="color:#0056b3;">
                <i class="fas fa-lock"></i> Change Password
            </h2>
            <hr style="background-color: #000; height: 2px;">
    
            <!-- Change Password Form -->
            <form method="post" action="{{ route('password.update') }}">
                @csrf
                @method('put')
    
                <!-- Current Password -->
                <div class="mb-3">
                    <label for="current-password" class="form-label"><strong><i class="fas fa-key"></i> Current Password:</strong></label>
                    <input type="password" class="form-control" id="current-password" name="current_password" placeholder="Enter current password" autocomplete="current-password" required>
                    @if ($errors->updatePassword->get('current_password'))
                        <div class="text-danger mt-1">
                            {{ $errors->updatePassword->first('current_password') }}
                        </div>
                    @endif
                </div>
    
                <!-- New Password -->
                <div class="mb-3">
                    <label for="new-password" class="form-label"><strong><i class="fas fa-lock"></i> New Password:</strong></label>
                    <input type="password" class="form-control" id="new-password" name="password" placeholder="Enter new password" autocomplete="new-password" required>
                    @if ($errors->updatePassword->get('password'))
                        <div class="text-danger mt-1">
                            {{ $errors->updatePassword->first('password') }}
                        </div>
                    @endif
                </div>
    
                <!-- Confirm New Password -->
                <div class="mb-3">
                    <label for="confirm-password" class="form-label"><strong><i class="fas fa-lock"></i> Confirm New Password:</strong></label>
                    <input type="password" class="form-control" id="confirm-password" name="password_confirmation" placeholder="Confirm new password" autocomplete="new-password" required>
                    @if ($errors->updatePassword->get('password_confirmation'))
                        <div class="text-danger mt-1">
                            {{ $errors->updatePassword->first('password_confirmation') }}
                        </div>
                    @endif
                </div>
    
                <!-- Submit Button -->
                <div class="text-center">
                    <button class="btn btn-warning w-100" style="background-color: #ffc107; border-color: #e0a800;">
                        <i class="fas fa-sync-alt"></i> Change Password
                    </button>
                </div>
    
                <!-- Success Message -->
                @if (session('status') === 'password-updated')
                    <div class="text-center mt-3">
                        <p class="text-success">{{ __('Password updated successfully.') }}</p>
                    </div>
                @endif
            </form>
        </div>
    </div>
</section>
