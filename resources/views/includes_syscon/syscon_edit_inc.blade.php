<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-buttonEdit">&times;</span>
        <h2>Edit System Content</h2>

        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" id="editId" name="id" />
            <div class="form-group">
                <label for="editName">Name:</label>
                <input
                    type="text"
                    id="editName"
                    name="name"
                    class="form-control"
                    required
                />
            </div>

            <div class="form-group">
                <label for="viewContent">Content</label>
                <input
                    type="text"
                    id="viewContent"
                    name="viewContent"
                    class="form-control"
                />
            </div>

            <div class="form-group">
                <label for="editContent">New Content:</label>
                <input
                    type="file"
                    name="content"
                    id="editContent"
                    class="form-control"
                    required
                />
            </div>
            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
