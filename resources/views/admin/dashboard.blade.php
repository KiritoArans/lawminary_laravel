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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <div class="container">
            <aside>
                @include('includes_accounts.nav_inc')
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        @include('includes_syscon.syscon_logo_inc')
                    </div>

                    <hr class="divider" />

                    <div class="header-line">
                        <div class="header-ttl">
                            <h1>Dashboard</h1>
                        </div>

                        <!-- Search Form -->
                        <div class="search-container">
                            <form
                                action="{{ route('admin.dashboard') }}"
                                method="GET"
                            >
                                <div class="input-group">
                                    <input
                                        type="text"
                                        name="search"
                                        class="form-control"
                                        placeholder="Search for activities"
                                        value="{{ request('search') }}"
                                    />
                                    <button
                                        class="btn btn-primary"
                                        type="submit"
                                    >
                                        Search
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Filter Button -->
                        <div class="filter-container">
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
                                    @include('includes_dashboard.dash_filter_inc')
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Close .header-line -->
                </header>
                <!-- Correctly close header tag -->

                <div class="content">
                    <div class="dash-content">
                        <div class="box-content">
                            <div class="boxes">
                                @include('includes_dashboard.pending_inc')
                                <div class="container-table-2">
                                    <!-- recent activity table -->
                                    @include('includes_dashboard.recent_act_inc')
                                </div>
                                <!-- Close .container-table-2 -->
                            </div>
                            <!-- Close .boxes -->
                        </div>
                        <!-- Close .box-content -->
                    </div>
                    <!-- Close .dash-content -->
                </div>
                <!-- Close .content -->
            </main>
            <!-- Close main -->

            <script src="{{ asset('js/admin_js/dashboard_js.js') }}"></script>
        </div>
    </body>
</html>
