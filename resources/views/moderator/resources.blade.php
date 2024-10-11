<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Resources</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/moderator/mrecourcesstyle.css') }}"
        />

        <link rel="stylesheet" href="{{ asset('css/base_pagination.css') }}" />

        <link rel="stylesheet" href="{{ asset('css/nav_burger.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('css/moderator/base_moderator_table_style.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/moderator/base_moderator_modal_style.css') }}"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
            integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <link
            href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <script src="{{ asset('js/library_js/sweetalertV2.js') }}"></script>
    </head>
    <body>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <header>
                    <div
                        class="header-top d-flex justify-content-between align-items-center"
                    >
                        @include('includes_accounts.mod_nav_inc')
                        @include('includes_syscon.syscon_logo_inc')
                    </div>
                    <hr class="divider w-100" />
                </header>

                <main class="col-12 col-md-9 mx-auto">
                    <div class="filter-container">
                        @include('includes_resources.search_res_inc')
                    </div>

                    <!-- Add and Filter Buttons -->
                    <div class="row justify-content-between align-items-center">
                        <!-- Filter Button -->
                        <div class="col-6 col-md-3 text-start">
                            <button
                                id="filterButton"
                                class="btn btn-primary w-100"
                            >
                                Filter
                            </button>
                        </div>

                        <!-- Add Button -->
                        <div class="col-6 col-md-3 text-end">
                            <button
                                class="btn btn-success w-100"
                                id="addButton"
                            >
                                Add
                            </button>
                        </div>
                    </div>
                    <div id="filterModal" class="modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <span class="close-button">&times;</span>

                                @include('includes_resources.filter_res_inc')
                            </div>
                        </div>
                    </div>
                    <div id="addModal" class="modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <span class="close-button">&times;</span>

                                <div class="error">
                                    @if ($errors->any())
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                @include('includes_resources.add_res_inc')
                            </div>
                        </div>
                    </div>

                    <!-- Resource Display Section -->
                    <div class="row">
                        <div class="col-12">
                            @include('includes_resources.display_res_inc')
                        </div>
                    </div>

                    <!-- View Modal -->
                    <div id="viewModal" class="modal">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <span class="close-button" id="closeButton">
                                    &times;
                                </span>
                                <h2>View Resource</h2>
                                <div class="error"></div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <script src="{{ asset('js/moderator_js/mresources_js.js') }}"></script>
    </body>
</html>
