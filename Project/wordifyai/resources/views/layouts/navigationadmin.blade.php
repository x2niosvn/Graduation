<nav class="navbar navbar-expand-lg navbar-dark bg-dark container shadow-sm" style="padding-bottom: 10px;">
    <div class="container-fluid">
        <!-- Toggler (Hiển thị trên màn hình nhỏ) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <!-- Dashboard -->
                <li class="nav-item">
                    <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                    </x-nav-link>
                </li>

                <!-- User Management -->
                <li class="nav-item">
                    <x-nav-link :href="route('user-management')" :active="request()->routeIs('user-management')">
                        <i class="fas fa-users-cog me-1"></i> User Management
                    </x-nav-link>
                </li>

                <!-- Analysis and Evaluation Management -->
                <li class="nav-item">
                    <x-nav-link :href="route('text-analysis-evaluation')" :active="request()->routeIs('text-analysis-evaluation')">
                        <i class="fas fa-chart-line me-1"></i> Analysis and Evaluation Management
                    </x-nav-link>
                </li>

                <!-- Suggestions Management -->
                <li class="nav-item">
                    <x-nav-link :href="route('text-analysis-evaluation')" :active="request()->routeIs('text-analysis-evaluation')">
                        <i class="fas fa-lightbulb me-1"></i> Suggestions Management
                    </x-nav-link>
                </li>
            </ul>
                
            <ul class="navbar-nav ms-auto">
                <!-- User Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center rounded shadow-sm" 
                       href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"
                       style="border: 1px solid rgb(255, 255, 255); padding: 8px 12px;">
                        <i class="fas fa-crown me-2 fs-5"></i>{{ Auth::user()->name }} - {{ Auth::user()->roleName() }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm rounded" aria-labelledby="userDropdown" 
                        style="border: 1px solid rgb(0, 0, 0);">
                        <li>
                            <a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="fas fa-user me-1"></i> Back to user page
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
