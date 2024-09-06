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
            href="{{ asset('css/admin/dashboardstyle.css') }}"
        />
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
                    {{-- navigation --}}
                    @include('includes_accounts.nav_inc')
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
                    <div class="header-line">
                        <div class="header-ttl">
                            <h1>Dashboard</h1>
                        </div>
                        <section class="filter-container">
                {{-- search function --}}
                <!-- @include('includes_accounts.search_inc') -->
                <div class="action-buttons">
                    <button class="custom-button" id="filterButton">Filter</button>
                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeFilterModal">&times;</span>
                            <h2>Filter Accounts</h2>
                            <!--filter accounts-->
                             @include('includes_dashboard.dash_filter_inc')
                        </div>
                    </div>
                    </div>
                </header>
                <div class="content">
                    <div class="dash-content">
                        <div class="box-content">
                            <div class="boxes">
                                @include('includes_dashboard.pending_inc')
                                    <div class="container-table-2">
                                        <!-- recent act table -->
                                        @include('includes_dashboard.recent_act_inc')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <script src="{{ asset('js/admin_js/dashboard_js.js') }}"></script>
        </div>
    </body>
</html>
