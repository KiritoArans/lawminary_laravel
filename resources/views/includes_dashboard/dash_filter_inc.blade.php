<form
    id="filterForm"
    method="GET"
    action="{{ request()->is('moderator*') ? route('moderator.filterDashboard') : route('admin.filterDashboard') }}"
>
    @csrf
    @include('inclusions.response')

    <label for="filterId">ID:</label>
    <input
        type="text"
        id="filterId"
        name="filterId"
        value="{{ request('filterId') }}"
    />

    <label for="filterUsername">Username:</label>
    <input
        type="text"
        id="filterUsername"
        name="filterUsername"
        value="{{ request('filterUsername') }}"
    />

    <label for="filterAction">Action:</label>
    <input
        type="text"
        id="filterAction"
        name="filterAction"
        value="{{ request('filterAction') }}"
    />

    <label for="filterDate">Date:</label>
    <input
        type="date"
        id="filterDate"
        name="filterDate"
        value="{{ request('filterDate') }}"
    />

    <button type="button" class="custom-button" onclick="resetFilter()">
        Reset Filter
    </button>

    <button type="submit" class="custom-button">Apply Filter</button>
</form>
