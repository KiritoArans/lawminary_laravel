<form id="delete-form-{{ $account->id }}" method="POST" style="display:inline;" action="{{ request()->is('moderator*') ? route('moderator.destroyAccount', $account->id) : route('admin.destroyAccount', $account->id) }}">
    
    @csrf
    @method('DELETE')
    @include('inclusions.response')
    <button type="button" class="delete-button" data-account-id="{{ $account->id }}">Delete</button>

</form>       