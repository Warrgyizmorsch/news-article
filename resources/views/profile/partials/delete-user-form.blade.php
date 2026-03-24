<section>
    <div class="mb-4">
        <h4 class="mb-1 text-danger">Delete Account</h4>
        <p class="text-muted mb-0">
            Once your account is deleted, all of its resources and data will be permanently deleted.
            Please enter your password to confirm you would like to permanently delete your account.
        </p>
    </div>

    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
        Delete Account
    </button>

    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" style="display:flex;justify-content:center;align-items:center;min-height:100vh;">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Delete Account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <p class="mb-3">
                            Are you sure you want to delete your account? Once your account is deleted,
                            all of its resources and data will be permanently deleted.
                        </p>

                        <div>
                            <label for="password" class="form-label">Password</label>
                            <input id="password" name="password" type="password" class="form-control"
                                placeholder="Enter your password">
                            @error('password', 'userDeletion')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>