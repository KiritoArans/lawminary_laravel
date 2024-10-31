<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | About Lawminary</title>
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
                    {{-- @include('includes_syscon.about_lawminary_inc') --}}
                    <div class="lawminary-desc">
                        <h1>Lawminary,</h1>
                        <p>Aims to create a community-centric platform that demystifies legal processes for the general public. It offers insights into various laws and facilitates a space where users can ask questions and receive answers from legal professionals, including lawyers. Users can post inquiries, attach relevant photos, and utilize a search function to find immediate answers or explore legal topics of interest. Moderators, primarily PAO Attorneys, will oversee content relevance and quality.</p>
                        <p>The platform is designed to benefit citizens by providing accessible legal information and promoting legal literacy. It also offers lawyers a way to connect with the community, enhance their credibility, and gain recognition through a points and rating system based on their participation and user feedback. This interactive feature encourages community engagement and the sharing of experiences related to legal matters. </p>
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
