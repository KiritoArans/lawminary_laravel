<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Admin</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/admin/accountstyle.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/base_pagination.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_burger.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('css/admin/base_admin_table_style.css') }}"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/admin/base_admin_modal_style.css') }}"
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
        <script src="{{ asset('js/library_js/sweetalertV2.js') }}"></script>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
    </head>

    <body>
        <div class="container-accounts">
            @include('includes_accounts.mod_nav_inc')
            <main>
                <header>
                    <div class="header-top">
                        <i class="fa-solid fa-bars"></i>
                        @include('includes_syscon.syscon_logo_inc')
                    </div>
                    <hr class="divider w-100" />
                </header>

                <!-- Filter Section -->
                <section class="filter-container">
                    <!-- Search and Filter Section -->
                    @include('includes_accounts.search_inc')

                    <div
                        class="action-buttons d-flex flex-wrap justify-content-between"
                    >
                        <!-- Filter Button -->
                        <button class="custom-button" id="filterButton">
                            Filter
                        </button>

                        <!-- Filter Modal -->
                        <div id="filterModal" class="modal">
                            <div class="modal-content">
                                <span
                                    class="close-button"
                                    id="closeFilterModal"
                                >
                                    &times;
                                </span>

                                @include('includes_accounts.filter_inc')
                            </div>
                        </div>

                        <!-- Add Account Button -->
                        @include('includes_accounts.pending_inc')
                        <button class="custom-button" id="addButton">
                            Add
                        </button>

                        <!-- Add Account Modal -->
                        <div id="addModal" class="modal">
                            <div class="modal-content">
                                <span class="close-button" id="closeAddModal">
                                    &times;
                                </span>

                                @include('includes_accounts.add_inc')
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Display Content Section (Table) -->
                <section class="table-responsive">
                    @include('includes_accounts.display_inc')
                </section>
            </main>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/admin_js/accounts_js.js') }}"></script>
    </body>
</html>
