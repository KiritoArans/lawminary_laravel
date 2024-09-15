<form
    id="editResourceForm"
    method="POST"
    enctype="multipart/form-data"
    action="{{ route('moderator.updateResource', $resource->id) }}"
>
    @csrf
    @method('PUT')

    <label>ID:</label>
    <input id="rsrcId" name="id" value="{{ $resource->id }}" readonly />

    <label>Document Name:</label>
    <input
        type="text"
        id="rsrcDocumentTitle"
        name="documentTitle"
        placeholder="Enter Document Name"
        value="{{ $resource->documentTitle }}"
    />

    <label>Document Description:</label>
    <input
        type="text"
        id="rsrcDocumentDesc"
        name="documentDesc"
        placeholder="Enter Description"
        value="{{ $resource->documentDesc }}"
    />

    <label for="newDocumentFile">Upload New File:</label>
    <input
        type="file"
        id="newDocumentFile"
        name="documentFile"
        accept=".pdf,.doc,.docx,.jpg,.png,.zip"
    />
    <a
        id="rsrcDocumentFileLink"
        href="{{ asset('storage/' . $resource->documentFile) }}"
        download
    >
        {{ $resource->documentFile }}
    </a>

    <label>Date Uploaded:</label>
    <input
        id="rsrcDateUploaded"
        name="created_at"
        value="{{ $resource->created_at->format('Y-m-d') }}"
        readonly
    />

    <button type="submit" class="custom-button">Save</button>
</form>
