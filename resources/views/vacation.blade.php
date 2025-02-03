<x-app-layout>
    @if (!empty(old()))
        @once
            @push('trigger-modal')
                <script>
                    $(document).ready(function() {
                        $('#request-vacation-modal').modal('show');
                    });
                </script>
            @endpush
        @endonce
    @endif

    <section x-init="() => {
        const urlParams = new URLSearchParams(window.location.search);
        const statusParams = urlParams.get('status');
        status = statusParams || 'all';
    }" x-data="{ start_date: '', status: 'all' }">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" x-bind:class="status == 'all' && 'active'" aria-current="page"
                    href="{{ route('vacation.index') }}">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" x-bind:class="status == 'pending' && 'active'"
                    href="{{ route('vacation.index', ['status' => 'pending']) }}">Menunggu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" x-bind:class="status == 'approved' && 'active'"
                    href="{{ route('vacation.index', ['status' => 'approved']) }}">Disetujui</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" x-bind:class="status == 'rejected' && 'active'"
                    href="{{ route('vacation.index', ['status' => 'rejected']) }}">Ditolak</a>
            </li>
        </ul>
        <br>
        <div class="flex-wrap gap-3 d-flex">
            @foreach ($vacationRequests as $vacationRequest)
                <div class="mb-2 card" style="padding:0;width: 32%">
                    <div class="card-header">
                        <span class="badge text-bg-{{ define_vacation_status($vacationRequest)['color'] }}">
                            {{ define_vacation_status($vacationRequest)['status'] }}
                        </span>
                        <br>
                        <span style="font-size: 12px; font-weight: bold">
                            Tanggal :
                            <small
                                style="font-size: 12px;">{{ Carbon\Carbon::parse($vacationRequest->start_date)->isoFormat('D MMMM YYYY') }}
                                s.d
                                {{ Carbon\Carbon::parse($vacationRequest->end_date)->isoFormat('D MMMM YYYY') }}</small>
                        </span>
                    </div>

                    <div class="card-body position-relative">
                        <div class="gap-2 d-flex">
                            <div class="vr" style="width: 3px;"></div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <span style="left: -10px;"
                                        class="p-2 border top-50 position-absolute translate-middle bg-danger border-light rounded-circle"></span>
                                    <h6 class="mb-1">Dibuat</h6>
                                    <p>
                                        <small style="font-size: 14px;">Update :
                                            {{ Carbon\Carbon::parse($vacationRequest->created_at)->diffForHumans() }}</small>
                                    </p>
                                </li>

                                <li class="list-group-item">
                                    <span style="left: -10px;"
                                        class="p-2 border top-50 position-absolute translate-middle bg-danger border-light rounded-circle"></span>
                                    <h6 class="mb-1">First Approver</h6>
                                    @if (!is_null($vacationRequest->first_approval_update_at))
                                        <p>
                                            <small style="font-size: 14px;">Update :
                                                {{ Carbon\Carbon::parse($vacationRequest->first_approval_update_at)->diffForHumans() }}</small>
                                        </p>
                                    @endif
                                    <span
                                        class="badge text-bg-{{ define_approval_status($vacationRequest->first_approval)['color'] }}">{{ define_approval_status($vacationRequest->first_approval)['status'] }}</span>
                                </li>

                                @if ($vacationRequest->first_approval)
                                    <li class="list-group-item">
                                        <span style="left: -10px;"
                                            class="p-2 border top-50 position-absolute translate-middle bg-danger border-light rounded-circle"></span>
                                        <h6 class="mb-1">Second Approver</h6>
                                        @if (!is_null($vacationRequest->second_approval_update_at))
                                            <p>
                                                <small style="font-size: 14px;">Update :
                                                    {{ Carbon\Carbon::parse($vacationRequest->second_approval_update_at)->diffForHumans() }}</small>
                                            </p>
                                        @endif
                                        <span
                                            class="badge text-bg-{{ define_approval_status($vacationRequest->second_approval)['color'] }}">{{ define_approval_status($vacationRequest->second_approval)['status'] }}</span>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div style="width: 85%" class="mx-auto">
            {{ $vacationRequests->withQueryString()->links('pagination::bootstrap-5') }}
        </div>

        <x-modal id="confirmation-modal">
            <div class="modal-body">
                Apakah anda yakin ingin mengajukan cuti? Pastikan data yang anda masukkan sudah benar.
            </div>
            <div class="modal-footer">
                <button type="button" data-bs-toggle="modal" data-bs-target="#request-vacation-modal"
                    class="btn btn-secondary">
                    Batalkan
                </button>
                <button x-on:click="() => {
                        $refs.create_form.submit()
                    }"
                    type="button" class="btn btn-primary">
                    Ya, Ajukan
                </button>
            </div>
        </x-modal>

        <x-modal title="Ajukan Cuti" id="request-vacation-modal">
            <form x-ref="create_form" method="POST">
                @csrf

                <div class="modal-body">
                    <div class="mb-2 input-group has-validation">
                        <span class="input-group-text">Start Date</span>
                        <input value="{{ old('start_date') }}" name="start_date"
                            x-on:change="() => {
                                start_date = $event.target.value
                            }"
                            type="date" class="form-control @error('start_date')
is-invalid
@enderror" required>
                        <div class="invalid-feedback">
                            <ul>
                                @error('start_date')
                                    <li><small>{{ $message }}</small></li>
                                @enderror
                            </ul>
                        </div>
                    </div>

                    <div class="mb-2 input-group has-validation">
                        <span class="input-group-text">End Date</span>
                        <input value="{{ old('end_date') }}" name="end_date" x-bind:min="start_date"
                            type="date" class="form-control @error('end_date') is-invalid @enderror">
                        <div class="invalid-feedback">
                            <ul>
                                @error('end_date')
                                    <li><small>{{ $message }}</small></li>
                                @enderror
                            </ul>
                        </div>
                    </div>

                    <div class="mb-2 input-group has-validation">
                        <div class="form-floating @error('departement') is-invalid @enderror"">
                            <select value="{{ old('departement') }}" name="departement_id"
                                class="form-select @error('departement') is-invalid @enderror" id="departement_id">
                                <option disabled>Departement</option>
                                @foreach ($departements as $departement)
                                    <option {{ $departement->id == old('departement') && 'selected' }}
                                        value="{{ $departement->id }}">{{ $departement->name }}</option>
                                @endforeach
                            </select>
                            <label for="departement_id">Pilih Departement</label>
                        </div>
                        <div class="invalid-feedback">
                            <ul>
                                @error('departement')
                                    <li><small>{{ $message }}</small></li>
                                @enderror
                            </ul>
                        </div>
                    </div>

                    <div class="mb-2 input-group has-validation">
                        <div class="form-floating @error('reason') is-invalid @enderror">
                            <textarea name="reason" class="form-control @error('reason') is-invalid @enderror"
                                placeholder="Keterangan / Alasan / Sebab" id="reason" style="height: 100px"></textarea>
                            <label for="reason">Keterangan</label>
                        </div>
                        <div class="invalid-feedback">
                            <ul>
                                @error('reason')
                                    <li><small>{{ $message }}</small></li>
                                @enderror
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#confirmation-modal">
                        Ajukan
                    </button>
                </div>
            </form>
        </x-modal>

        <button x-on:click="() => {
            departement = {}
        }" type="button" data-bs-toggle="modal"
            style="right:3%; bottom: 3%; width:60px; height:60px;" data-bs-target="#request-vacation-modal"
            class="rounded-circle btn btn-primary position-fixed">
            <x-icons.add />
        </button>
    </section>
</x-app-layout>
