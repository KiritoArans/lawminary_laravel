<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-buttonEdit">&times;</span>
        <h2>Edit System Content</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            id="editForm"
            method="POST"
            action="{{ route('admin.systemcontent.update', ['id' => $sysconData->first()->id]) }}"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <!-- Hidden input for ID and field type -->
            <input type="hidden" id="editId" name="id" />
            <input type="hidden" id="editField" name="field" />

            <!-- System Name Section -->
            <div class="form-group" id="nameField" style="display: none">
                <label for="editName">Name:</label>
                <input
                    type="text"
                    id="editName"
                    name="system_name"
                    class="form-control"
                />
            </div>

            <!-- About Lawminary Section -->
            <div
                class="form-group"
                id="about_LawminaryField"
                style="display: none"
            >
                <label for="editAboutLawminary">About Lawminary:</label>
                <textarea
                    id="editAboutLawminary"
                    name="about_lawminary"
                    class="form-control"
                    rows="5"
                ></textarea>
            </div>

            <!-- About PAO Section -->
            <div class="form-group" id="aboutPaoField" style="display: none">
                <label for="editAboutPao">About PAO:</label>
                <textarea
                    id="editAboutPao"
                    name="about_pao"
                    class="form-control"
                    rows="5"
                ></textarea>
            </div>

            <!-- Terms of Service Section -->
            <div
                class="form-group"
                id="termsOfServiceField"
                style="display: none"
            >
                <label for="editTermsOfService">Terms of Service:</label>
                <textarea
                    id="editTermsOfService"
                    name="terms_of_service"
                    class="form-control"
                    rows="5"
                ></textarea>
            </div>

            <!-- File input for Logo -->
            <div class="form-group" id="fileContentField" style="display: none">
                <label for="editLogo">Upload New Logo:</label>
                <input
                    type="file"
                    name="logo"
                    id="editLogo"
                    class="form-control"
                />
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
