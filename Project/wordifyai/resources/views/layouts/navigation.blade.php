<nav class="navbar navbar-expand-lg navbar-light bg-light container shadow-sm" style="border-bottom: 3px solid #007bff; padding-bottom: 10px;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <img src="{{ asset('img/wordifyai.png') }}" alt="WordifyAI logo" height="50" class="me-2">
        </a>

        <!-- Toggler (Hiển thị trên màn hình nhỏ) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Dashboard -->
                <li class="nav-item">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="fas fa-home me-1"></i> Dashboard
                    </x-nav-link>
                </li>
            </ul>
                
            <ul class="navbar-nav ms-auto">
                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center rounded shadow-sm" 
                       href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                       style="border: 1px solid rgba(0, 0, 0, 0.1); padding: 8px 12px;">
                        <i class="fas fa-user-circle me-2 fs-5"></i>{{ Auth::user()->name }} - {{ Auth::user()->roleName() }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded" aria-labelledby="userDropdown" 
                        style="border: 1px solid rgba(0, 0, 0, 0.1);">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="fas fa-user me-1"></i> Profile
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    <i class="fas fa-sign-out-alt me-1"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
