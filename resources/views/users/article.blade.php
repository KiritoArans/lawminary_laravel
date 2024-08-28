<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Article</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/article_style.css') }}">
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
                        <img src="../imgs/user-img.png" alt="Profile Picture">
                        <label>@Username</label>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li><a href="home" class="current"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
                        <li><a href="search"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a></li>
                        <li><a href="resources"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                        <li><a href="profile"><i class="fa-solid fa-user"></i><span>Profile</span></a></li>
                        <li>
                            <a onclick="toggleDropdown(event)"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
                            <div id="settingsDropdown" class="dropdown-content">
                                <ul>
                                    <li><a href="settings/lawminary">About Lawminary</a></li>
                                    <li><a href="settings/pao">About PAO</a></li>
                                    <li><a href="settings/account">Account Settings</a></li>
                                    <li><a href="settings/activitylogs">Activity Logs</a></li>
                                    <li><a href="settings/feedback">Provide Feedback</a></li>
                                    <li><a href="settings/tos">Terms of Service</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="bottom-nav">
                <a class="logout" href="login"><i class="fa-solid fa-right-from-bracket"></i><span>Log out</span></a>
            </div>
        </aside>
        
        <main>
        <header>
            <div class="header-top">
                <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
                <div class="notification">
                    <a href="notifications"><i class="fas fa-bell bell-icon"></i></a>
                </div>
            </div>
            <hr class="divider">
            <div class="header-buttons-search">
                <div class="header-buttons">
                    <button id="postsTab" class="posts-tab">Posts</button>
                    <button id="forumsTab" class="forums-tab">Forums</button>
                    <button id="articlesTab" class="articles-tab current-tab">Article</button>
                  </div> 
                <div class="search-bar">
                    <input type="text" placeholder="Search an Article">
                    <i class="fas fa-search search-icon"></i>
                </div>
            </div>
        </header>
        <content>
            <div class="article">
                <div class="article-content">
                    <h1>Article 1</h1>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid culpa libero soluta quibusdam, itaque delectus. Est vitae veritatis quibusdam, esse enim porro, cupiditate magni iure voluptatem, voluptate recusandae ad ratione!</p>
                </div>
                <div class="more-article">
                    <div class="article-content">
                        <h1>Article 2</h1>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid culpa libero soluta quibusdam, itaque delectus. Est vitae veritatis quibusdam, esse enim porro, cupiditate magni iure voluptatem, voluptate recusandae ad ratione!</p>
                    </div>
                    <div class="article-content">
                        <h1>Article 3</h1>
                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquid culpa libero soluta quibusdam, itaque delectus. Est vitae veritatis quibusdam, esse enim porro, cupiditate magni iure voluptatem, voluptate recusandae ad ratione!</p>
                    </div>
                </div>
            </div>
        </content>
        </main>
    <script src="../js/locator.js"></script>
    <script src="../js/settings.js"></script>
</body>
</html>
