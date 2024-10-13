<x-auth-layout>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card" style="width: 400px; border-radius: 10px;">
            <div class="card-body">
                <h4 class="card-title text-center">Login</h4>
                
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" id="login" onsubmit="return validateLoginForm()">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus autocomplete="username" value="{{ old('email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button type="submit" class="btn btn-primary w-100">{{ __('Log In') }}</button>
                    </div>

                    <div class="text-center">
                        <p class="mb-0">Don't have an account? <a href="{{ route('register') }}">Register now</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-auth-layout>
