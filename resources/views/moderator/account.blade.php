<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Moderator</title>
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
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
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
    </head>
    <body>
        <div class="container-fluid my-4">
            <aside>
                @include('includes_accounts.mod_nav_inc')
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        <img
                            src="../../imgs/Lawminary_Logo_2-Gold.png"
                            alt="Lawminary Logo"
                        />
                        <div class="spacer"></div>
                    </div>
                    <hr class="divider" />
                </header>
                <section class="filter-container">
                    @include('includes_accounts.search_inc')
                    <div class="action-buttons">
                        <button class="custom-button" id="filterButton">
                            Filter
                        </button>
                        <div id="filterModal" class="modal">
                            <div class="modal-content">
                                <span
                                    class="close-button"
                                    id="closeFilterModal"
                                >
                                    &times;
                                </span>
                                <h2>Filter Accounts</h2>
                                <!--filter accounts-->
                                @include('includes_accounts.filter_inc')
                            </div>
                        </div>
                        <!-- add accounts -->
                        @include('includes_accounts.pending_inc')
                        <button class="custom-button" id="addButton">
                            Add
                        </button>
                        <div id="addModal" class="modal">
                            <div class="modal-content">
                                <span class="close-button" id="closeAddModal">
                                    &times;
                                </span>
                                <h2>Add Account</h2>

                                @include('includes_accounts.add_inc')
                            </div>
                        </div>
                    </div>
                </section>
                <!-- display content on table -->
                <content class="table-container">
                    @include('includes_accounts.display_inc')
                </content>
            </main>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/admin_js/accounts_js.js') }}"></script>
    </body>
</html>
