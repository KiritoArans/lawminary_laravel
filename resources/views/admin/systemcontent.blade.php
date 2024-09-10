<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | System Content</title>
        <link
            rel="icon"
            href="{{ asset('imgs/lawminarylogo.png') }}"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="{{ asset('css/admin/systemcontentstyle.css') }}"
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
                        <div class="spacer"></div>
                    </div>
                    <hr class="divider" />
                </header>
                <content class="table-container">
                    <h1>System Content</h1>
                    @include('includes_syscon.syscon_search_inc')
                    @include('includes_syscon.syscon_table_inc')
                </content>
            </main>
        </div>
        <script src="{{ asset('js/admin_js/systemcontent_js.js') }}"></script>
    </body>
</html>
