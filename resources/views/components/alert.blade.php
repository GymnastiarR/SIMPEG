@props(['type' => 'info'])

@php
    $alertType = [
        'success' => 'success',
        'error' => 'danger',
        'warning' => 'warning',
        'info' => 'info',
    ];
@endphp

<div class="alert alert-{{ $alertType[$type] }}" role="alert">
    <div sty class="d-flex justify-content-between align-items-center">
        <span>
            {{ $slot }}
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
