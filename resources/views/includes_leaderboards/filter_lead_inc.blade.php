<form
    id="filterForm"
    method="GET"
    action="{{ route('moderator.filterLeaderboards') }}"
>
    <label for="filter_user_id">ID:</label>
    <input
        type="text"
        id="filter_user_id"
        name="filter_user_id"
        value="{{ request('filter_user_id') }}"
    />

    <label for="filterRank">Rank:</label>
    <input
        type="text"
        id="filterRank"
        name="filterRank"
        value="{{ request('filterRank') }}"
    />

    <label for="filterName">Name:</label>
    <input
        type="text"
        id="filterName"
        name="filterName"
        value="{{ request('filterName') }}"
    />

    <label for="filterPoints">Points:</label>
    <input
        type="text"
        id="filterPoints"
        name="filterPoints"
        value="{{ request('filterPoints') }}"
    />

    <label for="filterBadge">Badge:</label>
    <input
        type="text"
        id="filterBadge"
        name="filterBadge"
        value="{{ request('filterBadge') }}"
    />

    <button class="custom-button" type="submit">Apply Filters</button>
</form>
