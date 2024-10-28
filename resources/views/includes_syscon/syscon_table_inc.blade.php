<div class="content-sections">
    <p>*click cell to view data</p>

    <!-- System Logo Section -->
    <div class="mb-4">
        <strong>Logo:</strong>
        <div class="d-flex justify-content-between align-items-center">
            @if ($sysconData->isNotEmpty() && $sysconData->first()->logo_path)
                <img
                    src="{{ Storage::url($sysconData->first()->logo_path) }}"
                    alt="Logo"
                    class="clickable-photo"
                    width="150"
                    data-fullsize="{{ Storage::url($sysconData->first()->logo_path) }}"
                />
            @else
                <p>No logo uploaded</p>
            @endif

            <!-- Modal for showing full-size image -->
            <div id="imageModalPic" class="modal">
                <div class="modal-content">
                    <span class="close-modalPic" id="closeModalPic">
                        &times;
                    </span>
                    <img
                        id="fullImage"
                        src=""
                        alt="Full Image"
                        style="max-width: 100%; max-height: 80vh"
                    />
                </div>
            </div>

            <button
                class="btn btn-primary editButton ms-3"
                data-id="{{ $sysconData->first()->id ?? '' }}"
                data-type="logo"
                data-bs-toggle="modal"
                data-bs-target="#editModal"
                @if ($sysconData->isEmpty()) disabled @endif
            >
                Edit Logo
            </button>
        </div>
    </div>

    <!-- System Name Section -->
    <div class="mb-4">
        <strong>System Name:</strong>
        <div class="d-flex justify-content-between align-items-center">
            <p
                class="mb-0 clickable-text"
                data-full-text="{{ $sysconData->first()->system_name ?? 'No system name available' }}"
            >
                @if ($sysconData->isNotEmpty() && $sysconData->first()->system_name)
                    {{ Str::limit($sysconData->first()->system_name, 10) }}
                @else
                        No system name available
                @endif
            </p>

            <button
                class="btn btn-primary editButton ms-3"
                data-id="{{ $sysconData->first()->id ?? '' }}"
                data-type="system_name"
                data-name="{{ $sysconData->first()->system_name ?? '' }}"
                data-bs-toggle="modal"
                data-bs-target="#editModal"
                @if ($sysconData->isEmpty()) disabled @endif
            >
                Edit System Name
            </button>
        </div>
    </div>

    <!-- About Lawminary Section -->
    <div class="mb-4">
        <strong>About Lawminary:</strong>
        <div class="d-flex justify-content-between align-items-center">
            <p
                class="mb-0 clickable-text"
                data-full-text="{{ $sysconData->first()->about_lawminary ?? 'No information about Lawminary available' }}"
            >
                @if ($sysconData->isNotEmpty() && $sysconData->first()->about_lawminary)
                    {{ Str::limit($sysconData->first()->about_lawminary, 10) }}
                @else
                        No information about Lawminary available
                @endif
            </p>

            <button
                class="btn btn-primary editButton ms-3"
                data-id="{{ optional($sysconData->first())->id }}"
                data-type="about_lawminary"
                data-content="{{ optional($sysconData->first())->about_lawminary }}"
                @if ($sysconData->isEmpty()) disabled @endif
            >
                Edit About Lawminary
            </button>
        </div>
    </div>

    <!-- About PAO Section -->
    <div class="mb-4">
        <strong>About PAO:</strong>
        <div class="d-flex justify-content-between align-items-center">
            <p
                class="mb-0 clickable-text"
                data-full-text="{{ $sysconData->first()->about_pao ?? 'No information about PAO available' }}"
            >
                @if ($sysconData->isNotEmpty() && $sysconData->first()->about_pao)
                    {{ Str::limit($sysconData->first()->about_pao, 10) }}
                @else
                        No information about PAO available
                @endif
            </p>

            <button
                class="btn btn-primary editButton ms-3"
                data-id="{{ optional($sysconData->first())->id }}"
                data-type="about_pao"
                data-content="{{ optional($sysconData->first())->about_pao }}"
            >
                Edit About PAO
            </button>
        </div>
    </div>

    <!-- Terms of Service Section -->
    <div class="mb-4">
        <strong>Terms of Service:</strong>
        <div class="d-flex justify-content-between align-items-center">
            <p
                class="mb-0 clickable-text"
                data-full-text="{{ $sysconData->first()->terms_of_service ?? 'No terms of service available' }}"
            >
                @if ($sysconData->isNotEmpty() && $sysconData->first()->terms_of_service)
                    {{ Str::limit($sysconData->first()->terms_of_service, 10) }}
                @else
                        No terms of service available
                @endif
            </p>

            <button
                class="btn btn-primary editButton ms-3"
                data-id="{{ optional($sysconData->first())->id }}"
                data-type="terms_of_service"
                data-content="{{ optional($sysconData->first())->terms_of_service }}"
            >
                Edit Terms of Service
            </button>
        </div>
    </div>
</div>

<!-- Include your modal here for editing the fields -->
@include('includes_syscon.syscon_edit_inc')

<!-- Modal for showing cell data -->
<div id="textModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <p id="fullText"></p>
        <!-- Full text content will be injected here -->
    </div>
</div>
