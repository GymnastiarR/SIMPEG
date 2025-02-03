<x-app-layout>
    <x-slot:title>
        User
    </x-slot:title>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @session('modal')
        @once
            @push('trigger-modal')
                <script>
                    $(document).ready(function() {
                        $('#create-user-modal').modal('show');
                    });
                </script>
            @endpush
        @endonce
    @endsession

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">NIP</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->nip }}</td>
                    <td>{{ $user->email }}</td>
                    <td style="text-transform: capitalize;">{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <button x-on:click="() => {
        departement = {}
    }" type="button" data-bs-toggle="modal"
        style="right:3%; bottom: 5%; width:60px; height:60px; z-index: 10;" data-bs-target="#create-user-modal"
        class="rounded-circle btn btn-primary position-fixed">
        <x-icons.add />
    </button>

    <div style="width: 85%" class="mx-auto">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>

    <x-modal title="Tambah User" id="create-user-modal">
        <form x-ref="create_form" method="POST"" action="{{ route('user.store') }}">
            @csrf

            <div class="modal-body">
                <div class="mb-2 input-group has-validation">
                    <div class="form-floating @error('name') is-invalid @enderror">
                        <input value="{{ old('name') }}" name="name" type="text"
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
                    <div class="form-floating @error('name') is-invalid @enderror">
                        <input value="{{ old('email') }}" name="email" type="email"
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
                        <input value="{{ old('nip') }}" name="nip" type="text"
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

                <div class="mb-2 input-group has-validation">
                    <div class="form-floating @error('password') is-invalid @enderror">
                        <input name="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" id="password"
                            placeholder="Ex. Programmer" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-2 input-group has-validation">
                    <div class="form-floating @error('password_confirmation') is-invalid @enderror">
                        <input name="password_confirmation" type="password"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" placeholder="Ex. Programmer" required>
                        <label for="password">Reapet Password</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('password_confirmation')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div class="mb-2 input-group has-validation">
                    <div class="mb-3 form-floating">
                        <select value="{{ old('role') }}" name="role" class="form-select" id="role">
                            <option disabled selected>Role</option>
                            <option {{ old('role') == 'admin' ? 'selected' : '' }} value="admin">Admin</option>
                            <option {{ old('role') == 'employee' ? 'selected' : '' }} value="employee">Pegawai</option>
                            <option {{ old('role') == 'approver' ? 'selected' : '' }} value="approver">Approver
                            </option>
                        </select>
                        <label for="role">Pilih Role</label>
                    </div>
                    <div class="invalid-feedback">
                        @error('role')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
    </x-modal>

</x-app-layout>
