<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6">
            <div class="p-4 mb-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <h2>Informasi Profile</h2>
                <form method="post" action="{{ route('profile.update') }}">
                    @csrf
                    @method('patch')

                    <div class="mb-2 input-group has-validation">
                        <div class="form-floating @error('name') is-invalid @enderror">
                            <input value="{{ old('name', $user->name) }}" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror" id="name"
                                placeholder="Ex. Programmer" required>
                            <label for="name">Name</label>
                        </div>
                        <div class="invalid-feedback">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-2 input-group has-validation">
                        <div class="form-floating @error('email') is-invalid @enderror">
                            <input value="{{ old('email', $user->email) }}" disabled name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="Ex. Programmer" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="invalid-feedback">
                            @error('email')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-2 input-group has-validation">
                        <div class="form-floating @error('nip') is-invalid @enderror">
                            <input value="{{ old('nip', $user->nip) }}" name="nip" type="text"
                                class="form-control @error('nip') is-invalid @enderror" id="nip"
                                placeholder="xxxx-xxxx-xxxx" required>
                            <label for="nip">NIP</label>
                        </div>
                        <div class="invalid-feedback">
                            @error('nip')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Profile</button>
                </form>
            </div>

            <div class="p-4 bg-white shadow sm:p-8 sm:rounded-lg">
                <h2>Update Passoword</h2>
                <form method="post" action="{{ route('password.update') }}">
                    @csrf
                    @method('put')

                    <div class="mb-2 input-group has-validation">
                        <div class="form-floating @error('current_password') is-invalid @enderror">
                            <input name="current_password" type="text"
                                class="form-control @error('current_password') is-invalid @enderror"
                                id="current_password" placeholder="********" required>
                            <label for="current_password">Current Password</label>
                        </div>
                        <div class="invalid-feedback">
                            @error('current_password')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="mb-2 input-group has-validation">
                        <div class="form-floating @error('password') is-invalid @enderror">
                            <input name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="********" required>
                            <label for="password">Password</label>
                        </div>
                    </div>

                    <div class="mb-2 input-group has-validation">
                        <div class="form-floating @error('password_confirmation') is-invalid @enderror">
                            <input name="password_confirmation" type="password"
                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" placeholder="********" required>
                            <label for="password_confirmation">Reapet Password</label>
                        </div>
                        <div class="invalid-feedback">
                            @error('password_confirmation')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Password</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
