<x-admin-layout>
    <!-- Success or error notification -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-times-circle me-1"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif



    <!-- User list card with DataTables integration -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0"><i class="fas fa-users-cog me-2"></i> User Management</h5>
        </div>
    <div class="container">
        <!-- Button to add new user -->
        <div class="text mt-2">
            <a href="{{ route('user.create') }}" class="btn btn-success">
                <i class="fas fa-user-plus me-1"></i> Add New User
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="userTable" class="table table-hover table-striped align-middle w-100">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->role_id == 2 ? 'bg-primary' : 'bg-secondary' }}">
                                        {{ $user->role_id == 2 ? 'Admin' : 'User' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <!-- Edit button -->
                                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-warning me-1">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <!-- Delete button with SweetAlert confirmation -->
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(this)">
                                            <i class="fas fa-trash-alt"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No users found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>


    <script>
        // Initialize DataTables
        $(document).ready(function() {
            $('#userTable').DataTable({
                responsive: true,
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ users",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    },
                    emptyTable: "No users found"
                }
            });
        });

        // SweetAlert delete confirmation
        function confirmDelete(button) {
            swal({
                title: "Are you sure you want to delete this user?",
                text: "This action cannot be undone!",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancel",
                        visible: true,
                        className: "btn btn-secondary"
                    },
                    confirm: {
                        text: "Delete",
                        className: "btn btn-danger"
                    }
                },
                dangerMode: true
            }).then((willDelete) => {
                if (willDelete) {
                    button.closest('form').submit();
                }
            });
        }
    </script>
</x-admin-layout>
