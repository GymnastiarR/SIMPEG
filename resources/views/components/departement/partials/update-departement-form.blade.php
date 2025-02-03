<form method="POST" x-data="{ url: '{{ route('departement.index') }}' }" x-bind:action="url + '/' + departement.id">
    @csrf
    @method('PUT')

    <div class="modal-body">

        <div class="mb-2 input-group has-validation">
            <div class="form-floating @error('name') is-invalid @enderror">
                <input x-model="departement.name" value="{{ old('name') }}" name="name" type="text"
                    class="form-control @error('name') is-invalid @enderror" id="update_name"
                    placeholder="Ex. Programmer" required>
                <label for="update_name">Name</label>
            </div>
            <div class="invalid-feedback">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div x-data="{ selected: '' }" x-effect="selected = departement.first_approver_id"
            class="mb-2 input-group has-validation">
            <div class="form-floating @error('first_approver_id') is-invalid @enderror">
                <select x-model="selected" name="first_approver_id"
                    class="form-select @error('first_approver_id') is-invalid @enderror" id="update_first_approver_id">
                    <option>Open this select menu</option>
                    @foreach ($approvers as $approver)
                        <option @selected(old('first_approver_id') == $approver->id) value="{{ $approver->id }}">
                            {{ $approver->name }}
                        </option>
                    @endforeach
                </select>
                <label for="update_first_approver_id">First Approver</label>
            </div>
            <div class="invalid-feedback">
                <ul>
                    @error('first_approver_id')
                        <li>{{ $message }}</li>
                    @enderror
                </ul>
            </div>
        </div>

        <div x-data="{ selected: '' }" x-effect="selected = departement.second_approver_id"
            class="mb-2 input-group has-validation">
            <div class="form-floating @error('second_approver_id') is-invalid @enderror">
                <select x-model="selected" name="second_approver_id"
                    class="form-select  @error('second_approver_id') is-invalid @enderror"
                    id="update_second_approver_id">
                    <option disabled selected>Open this select menu</option>
                    @foreach ($approvers as $approver)
                        <option @selected(old('second_approver_id') == $approver->id) value="{{ $approver->id }}">
                            {{ $approver->name }}
                        </option>
                    @endforeach
                </select>
                <label for="update_second_approver_id">Second Approver</label>
            </div>
            <div class="invalid-feedback">
                <ul>
                    @error('second_approver_id')
                        <li>{{ $message }}</li>
                    @enderror
                </ul>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </div>
</form>
