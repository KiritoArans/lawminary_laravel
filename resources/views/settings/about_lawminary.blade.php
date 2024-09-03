<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | About Lawminary</title>
    <link rel="icon" href="../../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/about_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <aside>
            <div class="top-nav">
                <div class="profile">
                    <div class="user-indicator">
                        @if(Auth::user()->userPhoto)
                            <img src="{{ Storage::url(Auth::user()->userPhoto) }}" alt="Profile Picture">
                        @else
                            <img src="../../imgs/user-img.png" alt="Profile Picture">
                        @endif
                        <label>@<span>{{ Auth::user()->username }}</span></label>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li><a href="../home"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
                        <li><a href="../search"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a></li>
                        <li><a href="../resources"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                        <li><a href="../profile"><i class="fa-solid fa-user"></i><span>Profile</span></a></li>
                        <li>
                            <a class="current" onclick="toggleDropdown(event)"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
                            <div id="settingsDropdown" class="dropdown-content">
                                <ul>
                                    <li><a href="lawminary">About Lawminary</a></li>
                                    <li><a href="pao">About PAO</a></li>
                                    <li><a href="account">Account Settings</a></li>
                                    <li><a href="activitylogs">Activity Logs</a></li>
                                    <li><a href="feedback">Provide Feedback</a></li>
                                    <li><a href="tos">Terms of Service</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
                </nav>
            </div>
            <div class="bottom-nav">
                <a class="logout" href="../login"><i class="fa-solid fa-right-from-bracket"></i><span>Log out</span></a>
            </div>
        </aside>
        <main>
            <header>
                <div class="header-top">
                    <img src="../../imgs/Lawminary_Logo_2-Gold.png" alt="Lawminary Logo">
                    <div class="notification">
                        <a href="../notifications"><i class="fas fa-bell bell-icon"></i></a>
                    </div>
                </div>
                <hr class="divider">
            </header>
            <content class="about-content">
                <h2>About Lawminary</h2>
                <p>Lawminary is an innovative web-based platform designed to help individuals find legal information and resources easily. We aim to collaborate with the Public Attorney’s Office of Tanauan City to provide accurate and reliable legal information to the community.</p>
                <p>Our mission is to make legal information accessible to everyone, empowering individuals to understand their legal rights and obligations. We believe that access to legal information is a fundamental right and strive to make it available in a user-friendly and understandable manner.</p>
                <p>With Lawminary, users can search for legal topics, ask questions in forums, and access a wealth of resources curated by legal professionals. Join our community and be part of a platform that makes legal information accessible to all.</p>
            </content>
        </main>
    </div>
    <script src="../../js/settings.js"></script>
</body>
</html>
