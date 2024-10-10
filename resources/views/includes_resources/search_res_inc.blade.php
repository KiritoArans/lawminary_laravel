<div class="search-bar-content">
    <form
        action="{{ route('moderator.searchResources') }}"
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
    </form>
</div>
