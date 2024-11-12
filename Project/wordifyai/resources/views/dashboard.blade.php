<x-app-layout>
    <div class="container py-5">
        <!-- Dashboard Card -->
        <div class="card shadow mb-5">
            <div class="card-header bg-info text-white text-center">
                <h2 class="card-title mb-0"><i class="fas fa-tachometer-alt me-2"></i>User Dashboard</h2>
            </div>
            <div class="card-body">
                
                <!-- Quick Actions Section -->
                <div class="mb-4">
                    <h5 class="text-primary"><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
                    <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary me-2">
                        <i class="fas fa-user-edit me-1"></i>Edit Profile
                    </a>
                    <a href="{{ route('logout') }}" class="btn btn-outline-danger">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                </div>

                <!-- Recent Activities Section -->
                <div class="table-responsive mb-4">
                    <h5 class="text-primary"><i class="fas fa-history me-2"></i>Recent Activities</h5>
                    <table id="recentActivitiesTable" class="table table-hover table-bordered align-middle">
                        <thead class="table-light">
                            <tr>
                                <th><i class="fas fa-cog me-1"></i> ID</th>
                                <th><i class="fas fa-tasks me-1"></i> Action</th>
                                <th><i class="fas fa-clock me-1"></i> Timestamp</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Display list of recent activities -->
                            @foreach($histories as $historie)
                                <tr>
                                    <td>{{ $historie->id }}</td>
                                    <td><i class="fas fa-check-circle text-success me-2"></i> {{ $historie->action }}</td>
                                    <td>{{ $historie->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    <!-- DataTable Initialization Script -->
    <script>
        $(document).ready(function() {
            $('#recentActivitiesTable').DataTable({
                "order": [[2, "desc"]],
                "language": {
                    "search": "Search:",
                    "lengthMenu": "Show _MENU_ entries per page",
                    "info": "Showing _START_ to _END_ of _TOTAL_ activities",
                    "paginate": {
                        "first": "First",
                        "last": "Last",
                        "next": "Next",
                        "previous": "Previous"
                    },
                    "zeroRecords": "No activities found",
                    "infoEmpty": "No data to display",
                    "infoFiltered": "(filtered from _MAX_ total activities)"
                }
            });
        });
    </script>

    <!-- Optional JS for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</x-app-layout>
