<style>
    .navigation {
        width: 300px;
        position: sticky;
        top: 0;
        left: 0;
        height: 100vh;
        background-color: #1b1b24;
    }
</style>

<nav class="p-4 navigation">
    <div>
        <a href="/">
            <img src="/logo-v2.png" style="width: 94%" alt="">
        </a>
    </div>
    <hr>
    <div>
        <ul class="gap-2 p-0 d-flex flex-column list-unstyled">
            @if (Auth::user()->role == 'admin')
                <x-nav-link icon="icons.group" href="{{ route('departement.index') }}">
                    Departement
                </x-nav-link>
                <x-nav-link icon="icons.person" href="{{ route('user.index') }}">
                    Kepegawaian
                </x-nav-link>
            @elseif (Auth::user()->role == 'approver')
                <x-nav-link icon="icons.check-box" href="{{ route('approver.index') }}">
                    Pengajuan Cuti
                </x-nav-link>
            @else
                <x-nav-link icon="icons.holiday" href="{{ route('vacation.index') }}">
                    Cuti Pegawai
                </x-nav-link>
            @endif
        </ul>
    </div>
</nav>
