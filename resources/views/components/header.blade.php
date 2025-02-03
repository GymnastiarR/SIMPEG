@props(['notifications'])

@push('custom-local-style')
    <style>
        .dropdown-active {
            background-color: #f5f5f5;
        }
    </style>
@endpush

<header class="px-4 py-2 bg-white shadow d-flex justify-content-between align-items-center">
    <div class="dropdown">
        <a style="text-decoration: none; color:black" class="dropdown-toggle" href="#" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <span>
                <x-icons.user />
            </span>
            {{ Auth::user()->name }}
        </a>

        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
            <form style="cursor: pointer" method="POST" action="{{ route('logout') }}">
                @csrf

                <a class="dropdown-item" :href="route('logout')"
                    onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    Sign Out
                </a>
            </form>
        </ul>
    </div>

    <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <x-icons.notification />
            @if (get_notifications(Auth::user()->id)[1])
                <span
                    class="top-0 p-2 border position-absolute start-100 translate-middle bg-danger border-light rounded-circle">
                    <span class="visually-hidden">New alerts</span>
                </span>
            @endif
        </button>
        <ul style="width: 240px; font-size: 12px; max-height: 380px;" class="overflow-auto dropdown-menu">
            <li class="d-flex justify-content-between align-items-center">
                <h6 class="dropdown-header">Notifications</h6>
                {{-- <form action="" class="mx-3"> --}}
                <a href="{{ route('notification.read') }}" class="btn">
                    <x-icons.check />
                </a>
                {{-- </form> --}}
            </li>
            @forelse (get_notifications(Auth::user()->id)[0] as $notification)
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li style="{{ $notification->read_at ? '' : 'background-color: #f5f5f5;' }}">
                    <a style="text-wrap: balance;" class="dropdown-item dropdown-active"
                        href="{{ !is_null($notification->target) ? route($notification->target) : '#' }}">
                        <span style="display: block; margin-bottom: 4px;">
                            {{ $notification->content }}
                        </span>

                        <span>
                            {{ Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                        </span>
                    </a>
                </li>
            @empty
                <li><a class="dropdown-item" href="#">No notifications</a></li>
            @endforelse
        </ul>
    </div>
</header>
