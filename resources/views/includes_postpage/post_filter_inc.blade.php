<button class="custom-button" id="filterButton">Filter</button>
<div id="filterModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeFilterModal">&times;</span>
        <h2>Filter Posts</h2>
        <form
            id="filterForm"
            method="GET"
            action="{{ route('admin.filterPosts') }}"
        >
            <label for="filterPostId">Post ID:</label>
            <input type="text" id="filterPostId" name="filterPostId" />

            <label for="filterContent">Concern:</label>
            <input type="text" id="filterContent" name="filterContent" />

            <label for="filterStatus">Status:</label>
            <select id="filterStatus" name="filterStatus">
                <option value="">Select Status</option>
                <option value="approved">Approved</option>
                <option value="pending">Pending</option>
                <option value="disregarded">Disregarded</option>
            </select>

            <label for="filterTags">Tags:</label>
            <input type="text" id="filterTags" name="filterTags" />

            <label for="filterPostedBy">Posted By:</label>
            <input type="text" id="filterPostedBy" name="filterPostedBy" />

            <label for="filterApprovedBy">Approved by:</label>
            <input type="text" id="filterApprovedBy" name="filterApprovedBy" />

            <label for="filterDate">Date:</label>
            <input type="date" id="filterDate" name="filterDate" />

            <button type="submit" class="custom-button">Apply Filter</button>
        </form>
    </div>
</div>
