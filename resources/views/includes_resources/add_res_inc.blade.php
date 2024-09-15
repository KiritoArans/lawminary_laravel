<form
    id="resourceForm"
    enctype="multipart/form-data"
    method="post"
    action="{{ route('moderator.uploadResource') }}"
>
    @csrf
    <label for="documentTitle">Document Title:</label>
    <input
        type="text"
        id="documentTitle"
        name="documentTitle"
        placeholder="Enter Document Name"
        required
    />
    <label for="documentDesc">Document Description:</label>
    <input
        type="text"
        id="documentDesc"
        name="documentDesc"
        placeholder="Enter Description"
        required
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
    <div class="form-buttons">
        <button class="custom-button" type="submit">Add File</button>
    </div>
</form>
