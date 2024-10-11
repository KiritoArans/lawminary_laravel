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
<div id="editResourceModal" class="modal">
    <div class="modal-content">
        <span class="close-btnEdit">&times;</span>

        <div class="modal-body">
            <form
                id="editResourceForm"
                method="POST"
                action="{{ route('moderator.updateResource', $resource->id) }}"
                enctype="multipart/form-data"
            >
                @csrf
                @include('inclusions.response')
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

                <label for="documentFile">Upload File:</label>
                <input
                    class="custom-button"
                    type="file"
                    id="documentFile"
                    name="documentFile"
                    accept=".pdf,.doc,.docx,.jpg,.png,.zip"
                    required
                />

                <button type="submit" class="custom-button">
                    Save changes
                </button>
            </form>
            <form
                method="POST"
                action="{{ route('moderator.deleteResource', $resource->id) }}"
                onsubmit="return confirm('Are you sure you want to delete this resource?');"
            >
                @csrf
                @method('DELETE')
                <button type="submit" class="custom-button">Delete</button>
            </form>
        </div>
    </div>
</div>
