<button class="custom-button" id="addForumButton">Add Forum</button>

<!-- Add Forum Modal -->
<div id="addForumModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeAddForumModal">&times;</span>
        <h2>Add Forum</h2>
        <form
            id="addForumForm"
            method="POST"
            action="{{ route('createForum') }}"
            enctype="multipart/form-data"
        >
            @csrf
            @include('inclusions/response')
            <label for="addForumName">Forum Name:</label>
            <input type="text" id="addForumName" name="forumName" required />

            <label for="addForumPhoto">Forum Photo:</label>
            <input type="file" id="addForumPhoto" name="forumPhoto" />

            <label for="addForumDescription">Forum Description:</label>
            <input
                type="text"
                id="addForumDescription"
                name="forumDesc"
                required
            />

            <button type="submit" class="custom-button">Add Forum</button>
        </form>
    </div>
</div>
