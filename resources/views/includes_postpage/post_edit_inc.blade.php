<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-buttonEdit">&times;</span>

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
                <select
                    id="editStatus"
                    name="status"
                    class="form-control"
                    required
                >
                    <option value="Pending">Pending</option>
                    <option value="Approved">Approved</option>
                    <option value="Disregarded">Disregarded</option>
                </select>
            </div>

            <div class="form-group">
                <label for="editTags">Category:</label>
                <input
                    type="text"
                    id="editTags"
                    name="concernCategory"
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
                    readonly
                />
            </div>
            <div class="form-group">
                <label for="editApprovedBy">Approved By:</label>
                <input
                    type="text"
                    id="editApprovedBy"
                    name="approvedBy"
                    class="form-control"
                    readonly
                />
            </div>
            <button
                type="submit"
                class="btn btn-primary"
                id="saveChangesPostBtn"
            >
                Save Changes
            </button>
            <button
                type="button"
                class="deleteButton"
                data-id="{{ $postDelete->id }}"
            >
                Delete
            </button>
        </form>
    </div>
</div>
