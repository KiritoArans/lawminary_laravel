<form
    action="{{ request()->is('admin*') ? route('admin.searchPosts') : route('moderator.searchPosts') }}"
>
    <div class="search-bar-content">
        <div class="search-bar">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search posts..."
                value="{{ request('search') }}"
            />
        </div>
    </div>
</form>
