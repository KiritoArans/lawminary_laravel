<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Top Lawyers</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/leaderboards_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
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
                    <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
                    <div class="notification">
                        <a href="notifications" class="notification-link">
                            <i class="fas fa-bell bell-icon current"></i>
                            <span id="notification-count" class="notification-badge"></span>
                        </a>
                    </div>
                </div>
                <hr class="divider">
                <div class="header-buttons-search">
                    <div class="header-buttons">
                        <button id="postsTab" class="posts-tab">
                            <span>Posts</span>
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </button>
                        <button id="forumsTab" class="forums-tab">
                            <span>Forums</span>
                            <i class="fa-solid fa-users"></i>
                        </button>
                        <button id="articlesTab" class="articles-tab">
                            <span>Article</span>
                            <i class="fa-solid fa-scale-balanced"></i>
                        </button>
                        <button id="leaderboardsTab" class="leaderboards-tab current-tab">
                            <span>Top Lawyers</span>
                            <i class="fa-solid fa-chart-simple"></i>
                        </button>
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
                    <div class="leaderboards-ttl">
                        <i class="fa-solid fa-chart-simple"></i>
                        <h1>Top Lawyers</h1>
                    </div>
                    <div class="leaderboards-chart">
                        <button onclick="openBadgeChart()">Badge Chart</button>
                    </div>
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

            <div id="badgeModal" class="badgeModal">
                <div class="badgeModal-content">
                    <span class="badgeModal-close" onclick="closeBadgeChart()"><i class="fa-regular fa-circle-xmark"></i></span>
                    <div class="badgeList">
                        <table>
                            <tr>
                                <th>Rank</th>
                                <th>Points</th>
                                <th>Badge</th>
                            </tr>
                            <tr>
                                <td>Diamond</td>
                                <td>5000 Above</td>
                                <td><img src="../imgs/badges/diamond.png" alt="Diamond Badge"></td>
                            </tr>
                            <tr>
                                <td>Gold</td>
                                <td>3500 Above</td>
                                <td><img src="../imgs/badges/gold.png" alt="Gold Badge"></td>
                            </tr>
                            <tr>
                                <td>Silver</td>
                                <td>2000 Above</td>
                                <td><img src="../imgs/badges/silver.png" alt="Silver Badge"></td>
                            </tr>
                            <tr>
                                <td>Bronze</td>
                                <td>1000 Above</td>
                                <td><img src="../imgs/badges/bronze.png" alt="Bronze Badge"></td>
                            </tr>
                            <tr>
                                <td>Steel</td>
                                <td>500 Above</td>
                                <td><img src="../imgs/badges/steel.png" alt="Steel Badge"></td>
                            </tr>
                            <tr>
                                <td>Wood</td>
                                <td>500 Below</td>
                                <td><img src="../imgs/badges/wood.png" alt="Wood Badge"></td>
                            </tr>
                        </table>

                        @if($userRank && $userRankPoints)
                        
                            <label for="">My Record</label>
                            <table>
                                <tr>
                                    <td>{{ $userRank }} </td>
                                    <td class="userRankPoints">{{ $userRankPoints }}pts</td>
                                    <td class="userRankImg">
                                        <img src="{{ asset('imgs/badges/' . strtolower($userRank) . '.png') }}" alt="{{ $userRank }} Badge" width="40" class="badge-rank" title="{{ $userRank }} Badge">

                                    </td>
                                </tr>
                            </table>
                        @endif

                    </div>
                </div>
            </div>

        </content>
        </main>
    <script src="js/showUserNav.js"></script>
    <script src="js/showNotification.js"></script>
    <script src="js/visitProfileLb.js"></script>
    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html>