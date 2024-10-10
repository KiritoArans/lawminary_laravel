<form
    action="{{ request()->is('admin*') ? route('admin.searchAccounts') : route('moderator.searchAccounts') }}"
    method="GET"
>
    <div class="input-group">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search Accounts..."
            value="{{ request('search') }}"
        />
    </div>
</form>
