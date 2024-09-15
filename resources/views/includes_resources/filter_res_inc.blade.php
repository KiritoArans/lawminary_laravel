<form
    id="filterForm"
    method="GET"
    action="{{ route('moderator.filterResources') }}"
>
    <label for="filterId">Filter by ID:</label>
    <input
        type="text"
        id="filterId"
        name="filterId"
        value="{{ request('filterId') }}"
    />

    <label for="filterTitle">Filter by Resource Title:</label>
    <input
        type="text"
        id="filterTitle"
        name="filterTitle"
        value="{{ request('filterTitle') }}"
    />

    <label for="filterDesc">Filter by Document:</label>
    <input
        type="text"
        id="filterDesc"
        name="filterDesc"
        value="{{ request('filterDesc') }}"
    />

    <label for="filterDate">Filter by Date Uploaded:</label>
    <input
        type="date"
        id="filterDate"
        name="filterDate"
        value="{{ request('filterDate') }}"
    />

    <button class="custom-button" type="submit">Apply Filters</button>
</form>
