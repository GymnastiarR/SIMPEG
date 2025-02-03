<x-app-layout>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section x-init="() => {
        const urlParams = new URLSearchParams(window.location.search);
        const statusParams = urlParams.get('status');
        status = statusParams || 'all';
    }" x-data="{ start_date: '', status: 'all' }">

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" x-bind:class="status == 'all' && 'active'" aria-current="page"
                    href="{{ route('approver.index') }}">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" x-bind:class="status == 'pending' && 'active'"
                    href="{{ route('approver.index', ['status' => 'pending']) }}">Menunggu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" x-bind:class="status == 'approved' && 'active'"
                    href="{{ route('approver.index', ['status' => 'approved']) }}">Disetujui</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" x-bind:class="status == 'rejected' && 'active'"
                    href="{{ route('approver.index', ['status' => 'rejected']) }}">Ditolak</a>
            </li>
        </ul>
        <br>
        <div class="flex-wrap gap-3 d-flex">
            @foreach ($vacationRequests as $vacationRequest)
                <div class="mb-2 card" style="padding:0;width: 32%">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span class="badge text-bg-{{ approval_status($vacationRequest)['color'] }}">
                            {{ approval_status($vacationRequest)['status'] }}
                        </span>
                    </div>
                    <div class="card-body position-relative">
                        <div class="gap-2 d-flex">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">
                                    <h6 class="mb-1">Diajukan Oleh</h6>
                                    <p>
                                        <small style="font-size: 14px;">{{ $vacationRequest->user->name }}</small>
                                    </p>
                                    <p>
                                        <small style="font-size: 14px;">{{ $vacationRequest->user->nip }}</small>
                                    </p>
                                    <p>
                                        <span class="badge text-bg-primary">
                                            {{ $vacationRequest->departement->name }}
                                        </span>
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1">Periode Cuti</h6>
                                    <p>
                                        <small style="font-size: 14px;"> {{ $vacationRequest->start_date }} s.d
                                            {{ $vacationRequest->end_date }}</small>
                                    </p>
                                </li>
                                <li class="list-group-item">
                                    <h6 class="mb-1">Keterangan</h6>
                                    <p>
                                        <small style="font-size: 14px;">{{ $vacationRequest->reason }}</small>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </div>

                    @if (Auth::user()->id == $vacationRequest->departement->first_approver_id && is_null($vacationRequest->first_approval))
                        <div class="gap-3 card-footer d-flex align-items-center">
                            <form method="POST" action="{{ route('approver.approve', $vacationRequest->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="status" value="reject" hidden>
                                <button type="submit" class="btn btn-outline-secondary">Reject</button>
                            </form>
                            <form method="POST" action="{{ route('approver.approve', $vacationRequest->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="status" value="approve" hidden>
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                        </div>
                    @endif

                    @if (Auth::user()->id == $vacationRequest->departement->second_approver_id && is_null($vacationRequest->second_approval))
                        <div class="gap-3 card-footer d-flex align-items-center">
                            <form method="POST" action="{{ route('approver.approve', $vacationRequest->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="status" value="reject" hidden>
                                <button type="submit" class="btn btn-outline-secondary">Reject</button>
                            </form>
                            <form method="POST" action="{{ route('approver.approve', $vacationRequest->id) }}">
                                @csrf
                                @method('PUT')
                                <input type="text" name="status" value="approve" hidden>
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
        <div style="width: 85%" class="mx-auto">
            {{ $vacationRequests->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </section>
</x-app-layout>
