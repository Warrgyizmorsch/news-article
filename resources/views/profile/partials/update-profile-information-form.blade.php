<section>
    <div class="mb-4">
        <h4 class="mb-1">Profile Information</h4>
        <p class="text-muted mb-0">
            Update your account's profile information and email address.
        </p>
    </div>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')

        <div class="row g-3 mb-4">
            <label class="col-lg-3 col-form-label fw-semibold">Name</label>
            <div class="col-lg-9">
                <input id="name" name="name" type="text" class="form-control"
                    value="{{ old('name', $user->name) }}" required autocomplete="name">
                @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row g-3 mb-4">
            <label class="col-lg-3 col-form-label fw-semibold">Email</label>
            <div class="col-lg-9">
                <input id="email" name="email" type="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required autocomplete="username">
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-3">
                        <p class="text-warning mb-2">
                            Your email address is unverified.
                        </p>

                        <button form="send-verification" class="btn btn-warning btn-sm" type="submit">
                            Click here to re-send the verification email
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="text-success mt-2 mb-0">
                                A new verification link has been sent to your email address.
                            </p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2">
            <button type="submit" class="rs-btn text-center">
                Save Changes
            </button>
        </div>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success mt-3 mb-0">
                Profile updated successfully.
            </div>
        @endif
    </form>
</section>