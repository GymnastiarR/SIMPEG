@props(['messages'])

@if ($messages)
    {{-- <ul {{ $attributes->merge(['class' => 'fs-7 text-danger']) }}> --}}
    <ul class="mt-0 list-unstyled">
        @foreach ((array) $messages as $message)
            <li style="font-size: 12px" {{ $attributes->merge(['class' => 'text-danger']) }}>{{ $message }}</li>
        @endforeach
    </ul>
    {{-- </ul> --}}
@endif
