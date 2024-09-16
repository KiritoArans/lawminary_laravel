<div class="search-bar">
    <form action="{{ route('moderator.searchResources') }}" method="GET">
        <input
            type="text"
            id="searchInput"
            name="query"
            placeholder="Search resources..."
            value="{{ request()->query('query') }}"
        />
        <button type="submit">Search</button>
    </form>
</div>
