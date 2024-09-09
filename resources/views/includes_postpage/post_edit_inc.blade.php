<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
        <h2>Edit Post</h2>
        <form id="editForm" method="POST" action="{{ route('update') }}">
            @csrf
            <input type="hidden" name="post_id" id="editPostId" />
            <div class="form-group">
                <label for="editConcern">Concern:</label>
                <input
                    type="text"
                    id="editConcern"
                    name="concern"
                    class="form-control"
                />
            </div>
            <div class="form-group">
                <label for="editStatus">Status:</label>
                <select id="editStatus" name="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="disregarded">Disregarded</option>
                </select>
            </div>
            <div class="form-group">
                <label for="editTags">Tags:</label>
                <input
                    type="text"
                    id="editTags"
                    name="tags"
                    class="form-control"
                />
            </div>
            <div class="form-group">
                <label for="editPostedBy">Posted By:</label>
                <input
                    type="text"
                    id="editPostedBy"
                    name="postedBy"
                    class="form-control"
                />
            </div>
            <div class="form-group">
                <label for="editApprovedBy">Approved By:</label>
                <input
                    type="text"
                    id="editApprovedBy"
                    name="approvedBy"
                    class="form-control"
                />
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</div>
