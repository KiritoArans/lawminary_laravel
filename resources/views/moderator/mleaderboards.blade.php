<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Leaderboards</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/moderator/mleaderboardsstyle.css') }}"
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
    </head>
    <body>
        <div class="container">
            <aside>
                <div class="top-nav">
                    <div class="profile">
                        <div class="user-indicator">
                            <img
                                src="../../imgs/user-img.png"
                                alt="Profile Picture"
                            />
                            <label>@Username</label>
                        </div>
                    </div>
                    {{-- navigation for moderator --}}
                    @include('includes_accounts.mod_nav_inc')
                </div>
                <div class="bottom-nav">
                    <a class="logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Log out</span>
                    </a>
                </div>
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
                        @include('includes_leaderboards.search_led_inc')
                        <div class="filter-btn">
                            <button id="filterButton">Filter</button>
                        </div>
                        <div id="filterModal" class="modal">
                            <div class="modal-content">
                                <span class="close-button">&times;</span>
                                <h2>Filter Resources</h2>
                                @include('includes_leaderboards.filter_lead_inc')
                            </div>
                        </div>
                        <div id="filterModal" class="modal">
                            <div class="modal-content">
                                <span class="close-button">&times;</span>
                                <h2>Filter Posts</h2>

                                <form id="filterForm">
                                    <label for="filterRank">
                                        Filter by Rank:
                                    </label>
                                    <input
                                        type="text"
                                        id="filterRank"
                                        name="filterRank"
                                    />

                                    <label for="filterUsername">
                                        Filter by Username:
                                    </label>
                                    <input
                                        type="text"
                                        id="filterUsername"
                                        name="filterUsername"
                                    />

                                    <label for="filterPoints">
                                        Filter by Activity Points:
                                    </label>
                                    <input
                                        type="text"
                                        id="filterPoints"
                                        name="filterPoints"
                                    />

                                    <label for="filterBadge">
                                        Filter by Badge:
                                    </label>
                                    <input
                                        type="text"
                                        id="filterBadge"
                                        name="filterBadge"
                                    />

                                    <label for="filterAction">
                                        Filter by Action:
                                    </label>
                                    <input
                                        type="text"
                                        id="filterAction"
                                        name="filterAction"
                                    />

                                    <button type="submit">Apply Filters</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>
                <content>
                    @include('includes_leaderboards.display_lead_inc')
                    <div id="actionModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button">&times;</span>
                            <h2>Activity Details</h2>
                            <p>
                                <strong>Rank:</strong>
                                <span id="modalRank"></span>
                            </p>
                            <p>
                                <strong>Username:</strong>
                                <span id="modalUsername"></span>
                            </p>
                            <p>
                                <strong>Activity Points:</strong>
                                <span id="modalPoints"></span>
                            </p>
                            <p>
                                <strong>Badge:</strong>
                                <span id="modalBadge"></span>
                            </p>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="../../js/home_js.js"></script>
        <script src="{{ asset('js/moderator_js/mleaderboards_js.js') }}"></script>
    </body>
</html>
