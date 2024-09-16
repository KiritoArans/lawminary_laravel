<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Posts</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/admin/postpagestyle.css') }}"
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
        <div class="container">
            <aside>
                @include('includes_accounts.nav_inc')
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        <img
                            src="../../imgs/Lawminary_Logo_2-Gold.png"
                            alt=""
                        />
                        <div class="spacer"></div>
                    </div>
                    <hr class="divider" />
                </header>
                <div class="filter-container">
                    <!-- search and edit function -->
                    @include('includes_postpage.post_search_inc')
                    <div class="action-buttons">
                        <!-- view pending post -->
                        @include('includes_postpage.post_pending_inc')
                        <div id="pendingPostsModal" class="modal">
                            <div class="modal-content">
                                <span
                                    class="close-button"
                                    id="closePendingPostsModal"
                                >
                                    &times;
                                </span>
                                <h2>Pending Posts</h2>
                                <div id="pendingPostsContainer">
                                    <!-- Dynamic content will be added here -->
                                </div>
                            </div>
                        </div>
                        <!-- filter button -->
                        @include('includes_postpage.post_filter_inc')
                    </div>
                </div>
                <content class="container">
                    <!-- table -->
                    @include('includes_postpage.post_table_inc')
                </content>
            </main>
        </div>
        <script src="{{ asset('js/admin_js/postpage_js.js') }}"></script>
    </body>
</html>
