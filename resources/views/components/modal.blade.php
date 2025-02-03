@props(['title', 'id'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            @isset($title)
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $title }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            @endisset
            {{ $slot }}
        </div>
    </div>
</div>
