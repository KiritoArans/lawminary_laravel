<form action="{{ route('admin.searchAccounts') }}" method="GET">
    <div class="search-bar-content">
        <div class="search-bar">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search Accounts..."
                value="{{ request('search') }}"
            />
        </div>
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>
