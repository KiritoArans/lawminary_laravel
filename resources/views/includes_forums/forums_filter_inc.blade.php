<div class="action-buttons">
    <button class="custom-button" id="filterButton">Filter</button>

    <div id="filterModal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeFilterModal">&times;</span>

            <!-- Filter Form -->
            <form
                id="filterForm"
                action="{{ request()->is('admin*') ? route('admin.filterForums') : route('moderator.filterForums') }}"
                method="GET"
            >
                <label for="filterForumId">Forum ID:</label>
                <input type="text" id="filterForumId" name="filterForumId" />

                <label for="filterForumName">Forum Name:</label>
                <input
                    type="text"
                    id="filterForumName"
                    name="filterForumName"
                />

                <label for="filterForumDescription">Forum Description:</label>
                <input
                    type="text"
                    id="filterForumDescription"
                    name="filterForumDescription"
                />

                <label for="filterMembersCount">Members Count:</label>
                <input
                    type="number"
                    id="filterMembersCount"
                    name="filterMembersCount"
                />

                <label for="filterDateCreated">Date Created:</label>
                <input
                    type="date"
                    id="filterDateCreated"
                    name="filterDateCreated"
                />

                <button type="button" class="custom-button" id="resetButton">
                    Reset Filter
                </button>

                <button type="submit" class="custom-button">
                    Apply Filter
                </button>
            </form>
        </div>
    </div>
</div>
