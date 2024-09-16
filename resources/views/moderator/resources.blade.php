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

        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
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
    </head>
    <body>
        <div class="container">
            <aside>
                @include('includes_accounts.mod_nav_inc')
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        <img
                            src="../../imgs/Lawminary_Logo_2-Gold.png"
                            alt=""
                        />
                    </div>
                    <hr class="divider" />
                    <div class="filter-container">
                        @include('includes_resources.search_res_inc')
                    </div>

                    <div class="add-container">
                        <div class="filter-btn">
                            <button id="filterButton">Filter</button>
                        </div>
                        <div id="filterModal" class="modal">
                            <div class="modal-content">
                                <span class="close-button">&times;</span>
                                <h2>Filter Resources</h2>
                                @include('includes_resources.filter_res_inc')
                            </div>
                        </div>
                        <button class="custom-button" id="addButton">
                            Add
                        </button>
                    </div>
                    <div id="addModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Add Resource</h2>
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
                </header>
                <content>
                    @include('includes_resources.display_res_inc')
                    <div id="viewModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeButton">
                                &times;
                            </span>
                            <h2>View Resource</h2>
                            <div class="error"></div>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="{{ asset('js/moderator_js/mresources_js.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </body>
</html>
