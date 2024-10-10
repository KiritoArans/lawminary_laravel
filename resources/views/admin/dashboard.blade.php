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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <style>
            /* Center content vertically and horizontally */
            .dashboard-content-wrapper {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                flex-direction: column;
                text-align: center;
            }

            /* Adjust card and chart layout for responsiveness */
            .dashboard-cards {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                margin-bottom: 20px;
            }

            .chart-container {
                display: flex;
                justify-content: center;
                align-items: center;
                flex-direction: column;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid dashboard-content-wrapper">
            <!-- Header Section -->
            <header class="row">
                <div class="col-12 header-top">
                    @include('includes_syscon.syscon_logo_inc')
                    @include('includes_accounts.nav_inc')
                </div>
                <hr class="divider w-100" />
                <div class="col-12 header-line">
                    <h1 class="text-center">Dashboard</h1>
                    <!-- Centered heading below the logo -->
                </div>
            </header>
            <!-- Main Content Section -->
            <main class="row w-100">
                <!-- Dashboard Cards and Chart -->
                <div class="col-12 dashboard-cards">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        @include('includes_dashboard.pending_inc')
                    </div>
                </div>

                <!-- Chart Section -->
                <div class="col-12 chart-container">
                    @include('includes_dashboard.recent_act_inc')
                </div>
            </main>
        </div>

        <!-- Close main -->

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-3d"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment@1.0.0"></script>
        <script src="{{ asset('js/admin_js/dashboard_js.js') }}"></script>
    </body>
</html>
