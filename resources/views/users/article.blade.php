<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Article</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/article_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <div class="container">
        @include('inclusions/userNav')
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
                        <button id="leaderboardsTab" class="leaderboards-tab">Leaderboards</button>
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
    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html>
