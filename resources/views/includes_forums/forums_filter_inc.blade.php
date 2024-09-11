<!-- Button to trigger filter modal -->
<button
    id="filterButton"
    class="btn btn-info mb-3"
    data-bs-toggle="modal"
    data-bs-target="#filterModal"
>
    Filter Forums
</button>

<!-- Filter Modal -->
<div id="filterModal" class="modal">
    <div class="modal-content">
        <span class="close-buttonFilter">&times;</span>
        <h2>Filter Forums</h2>
        <form
            id="filterForm"
            method="GET"
            action="{{ route('admin.forums.filter') }}"
        >
            <div class="form-group">
                <label for="membersFilter">Filter by Members Count:</label>
                <select name="members" id="membersFilter" class="form-control">
                    <option value="">Select</option>
                    <option value="1-10">1-10 members</option>
                    <option value="11-50">11-50 members</option>
                    <option value="51-100">51-100 members</option>
                    <option value="101">More than 100 members</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dateFilter">Filter by Date Created:</label>
                <input
                    type="date"
                    name="date_created"
                    id="dateFilter"
                    class="form-control"
                />
            </div>

            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </form>
    </div>
</div>
