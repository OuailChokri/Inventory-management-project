<div class="row justify-content-center">
    <!-- Profile Information Form -->
    <div class="col-lg-8 col-md-10 col-sm-12 w-200"> <!-- Utilisation de différentes classes de colonne pour une largeur adaptative -->
        <div class="card" style="width: 100%;"> <!-- Définissez la largeur de la carte à 100% -->
            <div class="card-header">
                <h5 class="mb-0 text-capitalize">Profile Information</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('profile.update') }}" class="needs-validation" novalidate>
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label for="name" class="form-label text-secondary text-capitalize">Name</label>
                        <input id="name" name="name" type="text" class="form-control rounded" style="width: 100%" placeholder="Enter name"
                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        <div class="invalid-feedback">
                            Please provide a valid name.
                        </div>
                        @error('name')
                            <p class="text-sm text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label text-secondary text-capitalize">Email Address</label>
                        <input id="email" name="email" type="email" class="form-control rounded" style="width: 100%"
                            placeholder="Enter email" value="{{ old('email', $user->email) }}" required autocomplete="email">
                        <div class="invalid-feedback">
                            Please provide a valid email address.
                        </div>
                        @error('email')
                            <p class="text-sm text-danger">{{ $message }}</p>
                        @enderror
                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div>
                                <p class="text-sm mt-2 text-gray-800">
                                    Your email address is unverified.
                                    <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Click here to re-send the verification email.
                                    </button>
                                </p>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-2 font-medium text-sm text-green-600">
                                        A new verification link has been sent to your email address.
                                    </p>
                                @endif
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    @if (session('status') === 'profile-updated')
                        <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                            class="text-sm text-gray-600">Saved.</p>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
