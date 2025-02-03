@props(['approvers'])

<form method="POST" action="{{ route('departement.store') }}">
    <div class="modal-body">
        @csrf

        <div class="mb-2 input-group has-validation">
            <div class="form-floating @error('name') is-invalid @enderror">
                <input value="{{ old('name') }}" name="name" type="text"
                    class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Ex. Programmer"
                    required>
                <label for="name">Name</label>
            </div>
            <div class="invalid-feedback">
                @error('name')
                    {{ $message }}
                @enderror
            </div>
        </div>

        <div class="mb-2 input-group has-validation">
            <div class="form-floating @error('first_approver_id') is-invalid @enderror">
                <select name="first_approver_id" class="form-select @error('first_approver_id') is-invalid @enderror"
                    id="first_approver_id">
                    <option>Open this select menu</option>
                    @foreach ($approvers as $approver)
                        <option @selected(old('first_approver_id') == $approver->id) value="{{ $approver->id }}">
                            {{ $approver->name }}
                        </option>
                    @endforeach
                </select>
                <label for="first_approver_id">First Approver</label>
            </div>
            <div class="invalid-feedback">
                <ul>
                    @error('first_approver_id')
                        <li>{{ $message }}</li>
                    @enderror
                </ul>
            </div>
        </div>

        <div class="mb-2 input-group has-validation">
            <div class="form-floating @error('second_approver_id') is-invalid @enderror">
                <select name="second_approver_id" class="form-select  @error('second_approver_id') is-invalid @enderror"
                    id="second_approver_id">
                    <option disabled selected>Open this select menu</option>
                    @foreach ($approvers as $approver)
                        <option @selected(old('second_approver_id') == $approver->id) value="{{ $approver->id }}">
                            {{ $approver->name }}
                        </option>
                    @endforeach
                </select>
                <label for="second_approver_id">Second Approver</label>
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
        <button type="submit" class="btn btn-primary">Buat Departement</button>
    </div>
</form>
