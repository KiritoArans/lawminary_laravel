<div class="content-sections">
    <p>*click the name to view or edit data</p>

    <!-- System Logo Section -->
    <div
        class="mb-4 clickable-cell"
        data-id="{{ $sysconData->first()->id ?? '' }}"
        data-type="logo"
        data-bs-toggle="modal"
        data-bs-target="#editModal"
    >
        <strong>Logo:</strong>
        <div class="d-flex justify-content-center align-items-center">
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
        </div>
    </div>

    <!-- System Name Section -->
    <div
        class="mb-4 clickable-cell"
        data-id="{{ $sysconData->first()->id ?? '' }}"
        data-type="system_name"
        data-content="{{ $sysconData->first()->system_name ?? '' }}"
        data-desc="{{ $sysconData->first()->system_desc ?? '' }}"
        data-desc2="{{ $sysconData->first()->system_desc2 ?? '' }}"
    >
        <strong>System Section</strong>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p
                    class="mb-0 clickable-text"
                    data-full-text="{{ $sysconData->first()->system_name ?? 'No system name available' }}"
                >
                    {{ $sysconData->isNotEmpty() && $sysconData->first()->system_name ? $sysconData->first()->system_name : 'No system name available' }}
                </p>
                <div class="d-flex flex-column">
                    <p
                        class="mb-0 clickable-text"
                        data-full-text="{{ $sysconData->first()->system_desc ?? 'No description available' }}"
                    >
                        {{ $sysconData->isNotEmpty() && $sysconData->first()->system_desc ? $sysconData->first()->system_desc : 'No description available' }}
                    </p>
                    <p
                        class="mb-0 clickable-text"
                        data-full-text="{{ $sysconData->first()->system_desc2 ?? 'No additional description available' }}"
                    >
                        {{ $sysconData->isNotEmpty() && $sysconData->first()->system_desc2 ? $sysconData->first()->system_desc2 : 'No additional description available' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Partner's Name Section -->
    <div
        class="mb-4 clickable-cell"
        data-id="{{ $sysconData->first()->id ?? '' }}"
        data-type="partner_name"
        data-content="{{ $sysconData->first()->partner_name ?? '' }}"
        data-desc="{{ $sysconData->first()->partner_desc ?? '' }}"
        data-desc2="{{ $sysconData->first()->partner_desc2 ?? '' }}"
    >
        <strong>Partner’s Section</strong>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <p
                    class="mb-0 clickable-text"
                    data-full-text="{{ $sysconData->first()->partner_name ?? 'No partner name available' }}"
                >
                    {{ $sysconData->isNotEmpty() && $sysconData->first()->partner_name ? Str::limit($sysconData->first()->partner_name) : 'No partner name available' }}
                </p>
                <!-- Partner Description Fields Wrapper -->
                <div class="d-flex flex-column">
                    <p
                        class="mb-0 clickable-text"
                        data-full-text="{{ $sysconData->first()->partner_desc ?? 'No description available' }}"
                    >
                        {{ $sysconData->isNotEmpty() && $sysconData->first()->partner_desc ? $sysconData->first()->partner_desc : 'No description available' }}
                    </p>
                    <p
                        class="mb-0 clickable-text"
                        data-full-text="{{ $sysconData->first()->partner_desc2 ?? 'No additional description available' }}"
                    >
                        {{ $sysconData->isNotEmpty() && $sysconData->first()->partner_desc2 ? $sysconData->first()->partner_desc2 : 'No additional description available' }}
                    </p>
                </div>
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
        </div>
    </div>
</div>
