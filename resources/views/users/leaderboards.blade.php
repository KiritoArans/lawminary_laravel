<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Leaderboards</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/leaderboards_style.css') }}">
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
                        <button id="articlesTab" class="articles-tab">Article</button>
                        <button id="leaderboardsTab" class="leaderboards-tab current-tab">Leaderboards</button>
                    </div> 
                    <div class="search-bar">
                        <form id="searchForm" action="/home-search" method="GET">
                            <input type="text" name="query" id="searchQuery" placeholder="Search a user or post" required />
                            <i class="fas fa-search search-icon" onclick="document.getElementById('searchForm').submit();"></i>
                            <button type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </header>
        <content>
            <div id="leaderboards" data-logged-in-user-id="{{ Auth::check() ? Auth::user()->user_id : 'null' }}">
                <div class="leaderboards-header">
                    <i class="fa-solid fa-chart-simple"></i>
                    <h1>Leaderboards</h1>
                </div>

                @foreach ($leaderboards as $leaderboard)
                <div class="leaderboards-content" data-lawyer-id="{{ $leaderboard->lawyerUser_id }}">
                    <div class="rank">
                        {{ $loop->index + 1 }}
                    </div>
                    <div class="lawyer-user">
                        <span>Atty. {{ $leaderboard->firstName }} {{ $leaderboard->lastName }}</span>
                    </div>
                    <div class="points">
                        <span>{{ $leaderboard->rankPoints }} Points</span>
                    </div>
                    <div class="badge">
                        <img src="{{ asset('imgs/badges/' . strtolower($leaderboard->rank) . '.png') }}" alt="{{ $leaderboard->rank }} Badge" width="40" class="badge-rank" title="{{ $leaderboard->rank }} Badge">
                    </div>
                </div>

                @endforeach
            </div>
        </content>
        </main>
    <script src="js/visitProfileLb.js"></script>
    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html>
