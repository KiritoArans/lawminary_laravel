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
                    {{-- @include('includes_syscon.about_pao_inc') --}}
                    <div class="pao-desc">
                        <h1>Public Attorney's Office - Tanauan District,</h1>
                        <p>Public Attorney's Office is a government agency under the Department of Justice that provides free legal assistance to indigent individuals and marginalized communities. Established in 1973, PAO plays a crucial role in ensuring access to justice for those who cannot afford private legal counsel. Its primary mission is to protect the rights of clients, particularly in criminal cases, civil cases involving family law, and other legal matters affecting the vulnerable sectors of society.</p>
                        <p>PAO is composed of a nationwide network of public attorneys, each responsible for representing clients in various legal proceedings. These lawyers provide legal advice, draft legal documents, and represent clients in court, often handling cases related to criminal defense, legal aid for civil disputes, and administrative cases. The agency also engages in community outreach programs to educate the public about their legal rights and responsibilities, promoting legal literacy among Filipinos. PAO collaborates with local government units, non-governmental organizations, and other stakeholders to enhance access to justice and improve the overall legal system in the country.
                        </p>
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
