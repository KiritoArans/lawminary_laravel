<div class="search-bar-content">
    <form
        action="{{ route('moderator.searchLeaderboards') }}"
        method="GET"
        class="search-bar"
    >
        <input
            type="text"
            id="searchInput"
            name="query"
            placeholder="Search resources..."
            value="{{ request()->query('query') }}"
        />
        <button type="submit" class="custom-button">Search</button>
    </form>
</div>
