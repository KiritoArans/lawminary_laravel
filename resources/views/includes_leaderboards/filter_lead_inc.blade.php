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
