<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-buttonEdit">&times;</span>

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
            action="{{ $sysconData->isNotEmpty() ? route('admin.systemcontent.update', ['id' => $sysconData->first()->id]) : route('admin.systemcontent.store') }}"
            enctype="multipart/form-data"
        >
            @csrf
            @if ($sysconData->isNotEmpty())
                @method('PUT')
            @endif

            <!-- Hidden input for ID and field type -->
            <input type="hidden" id="editId" name="id" />
            <input type="hidden" id="editField" name="field" />

            <!-- System Name Section -->
            <div class="form-group" id="nameField" style="display: none">
                <strong>System Name</strong>
                <input
                    type="text"
                    id="editName"
                    name="system_name"
                    class="form-control"
                />
            </div>

            <!-- System Description Fields -->

            <div class="form-group" id="systemDescField" style="display: none">
                <strong>System Description</strong>
                <textarea
                    id="editSystemDesc"
                    name="system_desc"
                    class="form-control"
                    rows="3"
                ></textarea>
            </div>

            <div class="form-group" id="systemDesc2Field" style="display: none">
                <textarea
                    id="editSystemDesc2"
                    name="system_desc2"
                    class="form-control"
                    rows="3"
                ></textarea>
            </div>

            <!-- Partner Name Section -->

            <div class="form-group" id="partnerNameField" style="display: none">
                <strong>Partner's Name</strong>
                <input
                    type="text"
                    id="editPartnerName"
                    name="partner_name"
                    class="form-control"
                />
            </div>

            <!-- Partner Description Fields -->

            <div class="form-group" id="partnerDescField" style="display: none">
                <strong>Partner's Description</strong>
                <textarea
                    id="editPartnerDesc"
                    name="partner_desc"
                    class="form-control"
                    rows="3"
                ></textarea>
            </div>
            <div
                class="form-group"
                id="partnerDesc2Field"
                style="display: none"
            >
                <textarea
                    id="editPartnerDesc2"
                    name="partner_desc2"
                    class="form-control"
                    rows="3"
                ></textarea>
            </div>

            <div class="form-group" id="fileContentField" style="display: none">
                <strong>System Logo</strong>
                <div
                    id="logoPreviewContainer"
                    style="margin-bottom: 15px; display: none"
                >
                    <img
                        id="logoPreview"
                        src=""
                        alt="Logo Preview"
                        style="max-width: 100%; border-radius: 8px"
                    />
                </div>
                <input
                    type="file"
                    name="logo"
                    id="editLogo"
                    class="form-control"
                />
            </div>

            <button type="submit" class="btn btn-success" id="sysconButton">
                Update
            </button>
        </form>
    </div>
</div>
