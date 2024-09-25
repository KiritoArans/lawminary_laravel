<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Template</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="../styles/Template.css">
    <link rel="stylesheet" href="../styles/nav_style.css">
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
                        <img src="../imgs/user-img.png" alt="Profile Picture">
                        <label>@Username</label>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li><a href="home.html" style="color: #561C24;"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
                        <li><a href="search.html"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a></li>
                        <li><a href="resources.html"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                        <li><a href="search.html"><i class="fa-solid fa-user"></i><span>Profile</span></a></li>
                        <li>
                            <a onclick="toggleDropdown(event)"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
                            <div id="settingsDropdown" class="dropdown-content">
                                <ul>
                                    <li><a href="settings/about_lawminary.html">About Lawminary</a></li>
                                    <li><a href="settings/about_pao.html">About PAO</a></li>
                                    <li><a href="settings/account_settings.html">Account Settings</a></li>
                                    <li><a href="settings/activity_logs.html">Activity Logs</a></li>
                                    <li><a href="settings/provide_feedback.html">Provide Feedback</a></li>
                                    <li><a href="settings/tos.html">Terms of Service</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="bottom-nav">
                <a class="logout"><i class="fa-solid fa-right-from-bracket"></i><span>Log out</span></a>
            </div>
        </aside>
        
        <main>
        <header>
            <div class="header-top">
                <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
                <div class="notification">
                    <a href="notification.html"><i class="fas fa-bell bell-icon"></i></a>
                </div>
            </div>
            <hr class="divider">
            <div class="header-buttons-search">
                <div class="header-buttons">
                    <button class="post-button">Posts</button>
                    <button class="forum-button">Forums</button>
                    <button class="article-button">Article</button>
                </div>
                <div class="search-bar">
                    <input type="text" placeholder="Search a user or post">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>
        </header>
        <script src="../js/settings.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views\users\Template.blade.php ENDPATH**/ ?>