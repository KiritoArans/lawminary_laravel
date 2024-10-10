<div class="content-sections">
    <!-- System Logo Section -->
    <div class="mb-4">
        <strong>Logo:</strong>
        <div class="d-flex justify-content-between align-items-center">
            @if ($sysconData->isNotEmpty() && $sysconData->first()->logo_path)
                <img
                    src="{{ Storage::url($sysconData->first()->logo_path) }}"
                    alt="Logo"
                    class="img-fluid"
                    width="150"
                />
            @else
                <p>No logo uploaded</p>
            @endif
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
            <p class="mb-0">
                @if ($sysconData->isNotEmpty() && $sysconData->first()->system_name)
                    {{ $sysconData->first()->system_name }}
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
            <p class="mb-0">
                @if ($sysconData->isNotEmpty() && $sysconData->first()->about_lawminary)
                    {{ $sysconData->first()->about_lawminary }}
                @else
                        No information about Lawminary available
                @endif
            </p>
            <button
                class="btn btn-primary editButton ms-3"
                data-id="{{ $sysconData->first()->id }}"
                data-type="about_lawminary"
                data-content="{{ $sysconData->first()->about_lawminary }}"
            >
                Edit About Lawminary
            </button>
        </div>
    </div>

    <!-- About PAO Section -->
    <div class="mb-4">
        <strong>About PAO:</strong>
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0">
                @if ($sysconData->isNotEmpty() && $sysconData->first()->about_pao)
                    {{ $sysconData->first()->about_pao }}
                @else
                        No information about PAO available
                @endif
            </p>
            <button
                class="btn btn-primary editButton ms-3"
                data-id="{{ $sysconData->first()->id }}"
                data-type="about_pao"
                data-content="{{ $sysconData->first()->about_pao }}"
            >
                Edit About PAO
            </button>
        </div>
    </div>

    <!-- Terms of Service Section -->
    <div class="mb-4">
        <strong>Terms of Service:</strong>
        <div class="d-flex justify-content-between align-items-center">
            <p class="mb-0">
                @if ($sysconData->isNotEmpty() && $sysconData->first()->terms_of_service)
                    {{ $sysconData->first()->terms_of_service }}
                @else
                        No terms of service available
                @endif
            </p>
            <button
                class="btn btn-primary editButton ms-3"
                data-id="{{ $sysconData->first()->id }}"
                data-type="terms_of_service"
                data-content="{{ $sysconData->first()->terms_of_service }}"
            >
                Edit Terms of Service
            </button>
        </div>
    </div>
</div>

<!-- Include your modal here for editing the fields -->
@include('includes_syscon.syscon_edit_inc')
