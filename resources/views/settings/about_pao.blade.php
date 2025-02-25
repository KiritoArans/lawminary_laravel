<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | About PAO</title>
        <link rel="icon" href="../../imgs/lawminarylogo_v3.png" type="image/png" />
        <link rel="stylesheet" href="{{ asset('css/about_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/responsive/navres.css') }}" />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        <i class="fa-solid fa-bars"></i>
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="../notifications" class="notification-link">
                                <i class="fas fa-bell bell-icon current"></i>
                                <span id="notification-count" class="notification-badge"></span>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>
                <content class="about-content">
                    <div class="pao-desc">
                        @if ($sysconData->isNotEmpty())
                            @foreach ($sysconData as $data)
                                <h1>{{ $data->partner_name ?? 'N/A' }}</h1>
                                <p>{{ $data->partner_desc ?? 'N/A' }}</p>
                                <p>{{ $data->partner_desc2 ?? 'N/A' }}</p>
                            @endforeach
                        @else
                            <p>No data available.</p>
                        @endif
                    </div>
                    <div class="code404">
                        <p>Sincerely,</p>
                        <h2>Code 404</h2>
                    </div>
                </content>
            </main>
        </div>
        <script src="../js/showUserNav.js"></script>
        <script src="../js/showNotification.js"></script>
        <script src="../js/settings.js"></script>
        <script src="../js/logout.js"></script>
    </body>
</html>
