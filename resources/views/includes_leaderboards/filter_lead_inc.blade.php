<form action="{{ route('moderator.filterLeaderboards') }}" method="GET">
    <div class="form-group">
        <label for="filterRank">Rank:</label>
        <select name="filterRank" id="filterRank" class="form-control">
            <option value="">All Ranks</option>
            <option
                value="Wood"
                {{ request('filterRank') == 'Wood' ? 'selected' : '' }}
            >
                Wood
            </option>
            <option
                value="Steel"
                {{ request('filterRank') == 'Steel' ? 'selected' : '' }}
            >
                Steel
            </option>
            <option
                value="Bronze"
                {{ request('filterRank') == 'Bronze' ? 'selected' : '' }}
            >
                Bronze
            </option>
            <option
                value="Silver"
                {{ request('filterRank') == 'Silver' ? 'selected' : '' }}
            >
                Silver
            </option>
            <option
                value="Gold"
                {{ request('filterRank') == 'Gold' ? 'selected' : '' }}
            >
                Gold
            </option>
            <option
                value="Diamond"
                {{ request('filterRank') == 'Diamond' ? 'selected' : '' }}
            >
                Diamond
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="filterMinPoints">Minimum Points:</label>
        <input
            type="number"
            name="filterMinPoints"
            id="filterMinPoints"
            class="form-control"
            value="{{ request('filterMinPoints') }}"
        />
    </div>

    <div class="form-group">
        <label for="filterMaxPoints">Maximum Points:</label>
        <input
            type="number"
            name="filterMaxPoints"
            id="filterMaxPoints"
            class="form-control"
            value="{{ request('filterMaxPoints') }}"
        />
    </div>

    <button type="button" class="custom-button" onclick="resetFilter()">
        Reset Filter
    </button>

    <button type="submit" class="custom-button">Apply Filter</button>
</form>

<div id="filterModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>

        <form id="filterForm">
            <label for="filterRank">Filter by Rank:</label>
            <input type="text" id="filterRank" name="filterRank" />

            <label for="filterUsername">Filter by Username:</label>
            <input type="text" id="filterUsername" name="filterUsername" />

            <label for="filterPoints">Filter by Activity Points:</label>
            <input type="text" id="filterPoints" name="filterPoints" />

            <label for="filterBadge">Filter by Badge:</label>
            <input type="text" id="filterBadge" name="filterBadge" />

            <label for="filterAction">Filter by Action:</label>
            <input type="text" id="filterAction" name="filterAction" />

            <button type="submit">Apply Filters</button>
        </form>
    </div>
</div>
