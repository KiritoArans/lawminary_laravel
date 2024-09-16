<button
    class="view-button"
    data-id="{{ $resource->id }}"
    data-titleEdit="{{ $resource->documentTitle }}"
    data-descEdit="{{ $resource->documentDesc }}"
    data-fileEdit="{{ $resource->documentFile }}"
>
    Edit
</button>

<!-- Modal structure -->
<!-- Modal structure -->
<div id="editResourceModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close-btnEdit">&times;</span>
            <h2>Edit Resource</h2>
        </div>
        <div class="modal-body">
            <form
                id="editResourceForm"
                method="POST"
                action="{{ route('moderator.updateResource', $resource->id) }}"
                enctype="multipart/form-data"
            >
                @csrf
                <label for="resourceId">Content ID</label>
                <input type="text" name="id" id="resourceId" readonly />

                <label for="documentTitleEdit">Title</label>
                <input
                    type="text"
                    id="documentTitleEdit"
                    name="documentTitle"
                    required
                />

                <label for="documentDescEdit">Description</label>
                <textarea
                    id="documentDescEdit"
                    name="documentDesc"
                    required
                ></textarea>

                <label for="documentFileName">File</label>
                <input
                    type="text"
                    id="documentFileName"
                    name="documentFileCall"
                    readonly
                />

                <label for="documentFileEdit">File</label>
                <input type="file" id="documentFileEdit" name="documentFile" />

                <button type="submit">Save changes</button>
            </form>
        </div>
    </div>
</div>
