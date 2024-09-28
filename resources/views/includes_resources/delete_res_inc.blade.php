<form
    id="delete-form-{{ $resource->id }}"
    method="POST"
    action="{{ route('moderator.deleteResource', $resource->id) }}"
>
    @csrf
    @method('DELETE')
    @include('inclusions.response')
    <button
        type="button"
        class="custom-button"
        onclick="confirmDelete('{{ $resource->id }}')"
    >
        Delete
    </button>
</form>
