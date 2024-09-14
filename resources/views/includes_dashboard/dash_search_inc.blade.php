<div class="search-container"></div>
<form
    action="{{ request()->is('admin*') ? route('admin.search') : route('moderator.search') }}"
    method="GET"
>
    <div class="input-group">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search for activities"
            value="{{ request('search') }}"
        />
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>
