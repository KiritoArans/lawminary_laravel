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
            placeholder="Search Leaderboards..."
            value="{{ request('query') }}"
        />
    </form>
</div>
