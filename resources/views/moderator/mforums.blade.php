<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Moderator Forums</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/moderator/mforumsstyle.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/nav_burger.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/base_pagination.css') }}" />
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
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css"
            rel="stylesheet"
        />

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container-fluid dashboard-content-wrapper">
            @include('includes_accounts.mod_nav_inc')

            <main>
                <header class="row">
                    <div class="col-12 header-top">
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="spacer"></div>
                    </div>
                    <hr class="divider w-100" />
                </header>
                <!-- Search Form -->
                <form
                    action="{{ route('moderator.searchForums') }}"
                    method="GET"
                >
                    <div class="form-group">
                        <div class="input-group">
                            <input
                                type="text"
                                name="query"
                                class="form-control"
                                placeholder="Search for Forums or Key Words..."
                            />
                        </div>
                    </div>
                </form>

                <section class="filter-container my-4">
                    <div class="d-flex justify-content-center">
                        <!-- Filter Button and Modal -->
                        @include('includes_forums.forums_filter_inc')

                        <!-- Add Forum Button and Modal -->
                        @include('includes_forums.forums_add_inc')
                    </div>
                </section>

                <!-- Forums View Section -->
                <div class="table-responsive">
                    @include('includes_forums.forums_view_inc')
                </div>
            </main>
        </div>

        <script src="{{ asset('js/moderator_js/mforums_js.js') }}"></script>
    </body>
</html>
