<section>
    <div class="card" style="background-color: #f8f9fa; color: #343a40; border: 1px solid #0056b3; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
        <div class="container mb-4 mt-4">
            <h2 class="text-center mb-4" style="color:#0056b3;">
                <i class="fas fa-user-times"></i> Delete Account
            </h2>
            <hr style="background-color: #0056b3; height: 2px;">
            <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</p>
    
            <!-- Delete Account Button -->
            <div class="text-center">
                <button data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" class="btn btn-danger w-100" style="background-color: #dc3545; border-color: #c82333;">
                    <i class="fas fa-trash-alt"></i> Delete Account
                </button>
            </div>
        </div>
    </div>
    
    <!-- Modal for Confirming Deletion -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="confirmDeleteModalLabel"><i class="fas fa-exclamation-triangle"></i> Confirm Account Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                    @csrf
                    @method('delete')

                    <div class="modal-body">
                        <p>Are you sure you want to delete your account? Once deleted, all data will be permanently removed. Please enter your password to confirm.</p>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" value="{{ old('password') }}">
                            @if ($errors->userDeletion->get('password'))
                                <div class="text-danger mt-1">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash-alt"></i> Delete Account
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</section>
