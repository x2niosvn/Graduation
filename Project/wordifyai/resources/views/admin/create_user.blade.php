<x-admin-layout>
    <!-- Success notification -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- User creation form -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i> Add New User</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <!-- Name input -->
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="text-danger">{{ $message }}</div> <!-- Hiển thị thông báo lỗi ở đây -->
                    @enderror
                </div>

                <!-- Email input -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="text-danger">{{ $message }}</div> <!-- Hiển thị thông báo lỗi ở đây -->
                    @enderror
                </div>

                <!-- Role selection -->
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <select name="role_id" id="role_id" class="form-select @error('role_id') is-invalid @enderror" required>
                        <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>User</option>
                        <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role_id')
                        <div class="text-danger">{{ $message }}</div> <!-- Hiển thị thông báo lỗi ở đây -->
                    @enderror
                </div>

                <!-- Password input -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                    @error('password')
                        <div class="text-danger">{{ $message }}</div> <!-- Hiển thị thông báo lỗi ở đây -->
                    @enderror
                </div>

                <!-- Confirm Password input -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required>
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div> <!-- Hiển thị thông báo lỗi ở đây -->
                    @enderror
                </div>

                <!-- Submit button with left and right alignment -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('user-management') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to User Management
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-1"></i> Save User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
