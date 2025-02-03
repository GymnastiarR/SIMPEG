<x-app-layout>
    <x-slot:title>
        Departement
    </x-slot:title>

    @session('modal')
        @push('trigger-modal')
            <script>
                $(document).ready(function() {
                    $('{{ $value }}').modal('show');
                });
            </script>
        @endpush
    @endsession

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div x-data="{ departement: {{ json_encode(old()) }}, approvers: {{ $approvers }} }" x-init="() => { departement.id = `{{ session()->has('departement_id') ? session()->get('departement_id') : '' }}` }">
        <div class="flex-wrap gap-3 d-flex">
            @foreach ($departements as $departement)
                <div class="mb-2 card" style="padding:0;width: 32%">
                    <div class="card-header">
                        {{ $departement->name }}
                    </div>
                    <div class="card-body">
                        <ul class="mb-3 list-group list-group-flush">
                            <li class="list-group-item">
                                <h6 class="mb-1">{{ $departement->firstApprover->name }}</h6>
                                <p>{{ $departement->firstApprover->nip }}</p>
                                <p>
                                    <span class="badge text-bg-warning">
                                        First Approver
                                    </span>
                                </p>
                            </li>
                            <li class="list-group-item">
                                <h6 class="mb-1">{{ $departement->secondApprover->name }}</h6>
                                <p>{{ $departement->secondApprover->nip }}</p>
                                <p>
                                    <span class="badge text-bg-success">
                                        Secondary Approver
                                    </span>
                                </p>
                            </li>
                        </ul>
                        <button
                            x-on:click="() => {
                                departement = {{ $departement }}
                            }"
                            type="button" class="btn btn-primary" style="display: block; width: 100%;"
                            data-bs-toggle="modal" data-bs-target="#update-departement-modal">
                            <small>Sunting Departemen</small>
                        </button>
                    </div>
                </div>
            @endforeach
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

        <x-modal id="create-departement-modal" title="Buat Departemen">
            <x-departement.partials.create-departement-form :approvers="$approvers" />
        </x-modal>

        <x-modal id="update-departement-modal" title="Sunting Departemen">
            <x-departement.partials.update-departement-form :approvers="$approvers" />
        </x-modal>

        <button x-on:click="() => {
            departement = {}
        }" type="button" data-bs-toggle="modal"
            style="right:3%; bottom: 3%; width:60px; height:60px;" data-bs-target="#create-departement-modal"
            class="rounded-circle btn btn-primary position-fixed">
            <x-icons.add />
        </button>
    </div>
</x-app-layout>
