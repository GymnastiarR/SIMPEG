@props(['icon', 'href' => '#'])

@php
    $isActive = url()->current() == $href;
@endphp

<li>
    <a href="{{ $href }}" class="rounded"
        style="color:white; padding: 8px 12px;  text-decoration: none; font-size: 14px; display: flex; {{ $isActive ? 'background-color: #333;' : '' }}">
        <span style="margin-right: 8px;">
            <x-dynamic-component :component="$icon" />
        </span>
        <span class="item">{{ $slot }}</span>
    </a>
</li>
