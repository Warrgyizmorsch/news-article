<section>
    <div class="mb-4">
        <h4 class="mb-1">Update Password</h4>
        <p class="text-muted mb-0">
            Ensure your account is using a long, random password to stay secure.
        </p>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="row g-3 mb-4">
            <label class="col-lg-3 col-form-label fw-semibold">Current Password</label>
            <div class="col-lg-9">
                <input id="update_password_current_password" name="current_password" type="password"
                    class="form-control" autocomplete="current-password">
                @error('current_password', 'updatePassword')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <label class="col-lg-3 col-form-label fw-semibold">New Password</label>
            <div class="col-lg-9">
                <input id="update_password_password" name="password" type="password"
                    class="form-control" autocomplete="new-password">
                @error('password', 'updatePassword')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <label class="col-lg-3 col-form-label fw-semibold">Confirm Password</label>
            <div class="col-lg-9">
                <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                    class="form-control" autocomplete="new-password">
                @error('password_confirmation', 'updatePassword')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="rs-btn text-center">
                Update Password
            </button>
        </div>

        @if (session('status') === 'password-updated')
            <div class="alert alert-success mt-3 mb-0">
                Password updated successfully.
            </div>
        @endif
    </form>
</section>