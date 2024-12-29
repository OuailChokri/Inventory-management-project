<div class="row justify-content-center"> <!-- Centrer la colonne -->
    <!-- Update Password Section -->
    <div class="col-lg-8 col-md-10 col-sm-12 w-200"> <!-- Utilisation de différentes classes de colonne pour une largeur adaptative -->
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0 text-capitalize">Update Password</h5>
            </div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="update_password_current_password" class="form-label text-secondary text-capitalize">Current Password</label>
                        <input id="update_password_current_password" name="current_password" type="password" class="form-control rounded" style="width: 100%" autocomplete="current-password">
                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password" class="form-label text-secondary text-capitalize">New Password</label>
                        <input id="update_password_password" name="password" type="password" class="form-control rounded" style="width: 100%" autocomplete="new-password">
                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-3">
                        <label for="update_password_password_confirmation" class="form-label text-secondary text-capitalize">Confirm Password</label>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control rounded" style="width: 100%" autocomplete="new-password">
                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="btn btn-primary">Save</button>
                        @if (session('status') === 'password-updated')
                            <p
                                x-data="{ show: true }"
                                x-show="show"
                                x-transition
                                x-init="setTimeout(() => show = false, 2000)"
                                class="text-sm text-gray-600"
                            >Saved.</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
