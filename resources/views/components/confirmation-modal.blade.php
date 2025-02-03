@props(['id', 'message'])

<x-modal :id="$id">
    <div class="modal-body">
        {{ $message }}
    </div>
    <div class="modal-footer">
        <button type="button" data-bs-toggle="modal" data-bs-target="#request-vacation-modal" class="btn btn-secondary">
            Batalkan
        </button>
        <button x-on:click="() => {
            $refs.create_form.submit()
        }" type="button"
            class="btn btn-primary">
            Ajukan
        </button>
    </div>
</x-modal>
