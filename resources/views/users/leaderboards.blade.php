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
            <div class="leaderboards">
                <div class="leaderboards-header">
                    <i class="fa-solid fa-chart-simple"></i>
                    <h1>Leaderboards</h1>
                </div>

                @foreach ($leaderboards as $leaderboard)
                <div class="leaderboards-content">
                    <div class="rank">
                        {{ $loop->index + 1 }}
                    </div>
                    <div class="lawyer-user">
                        {{-- <a href="{{ Auth::check() && Auth::user()->user_id == $leaderboard->lawyerUser_id ? route('profile') : route('visit-profile', ['user_id' => $leaderboard->lawyerUser_id]) }}"> --}}
                        <span>Atty. {{ $leaderboard->firstName }} {{ $leaderboard->lastName }}</span>
                        {{-- </a> --}}
                    </div>
                    <div class="points">
                        <span>{{ $leaderboard->rankPoints }} Points</span>
                    </div>
                    <div class="badge">
                        @if ($leaderboard->rank === 'Wood')
                            <img src="{{ asset('imgs/badges/wood.png') }}"
                            alt="Wood Badge" class="clickable-photo" width="40" 
                            data-fullsize="{{ asset('imgs/badges/wood.png') }}"/>

                        @elseif ($leaderboard->rank === 'Steel')
                            <img src="{{ asset('imgs/badges/steel.png') }}"
                            alt="Steel Badge" class="clickable-photo" width="40" 
                            data-fullsize="{{ asset('imgs/badges/steel.png') }}"/>

                        @elseif ($leaderboard->rank === 'Bronze')
                            <img src="{{ asset('imgs/badges/bronze.png') }}"
                            alt="Bronze Badge" class="clickable-photo" width="40" 
                            data-fullsize="{{ asset('imgs/badges/bronze.png') }}"/>

                        @elseif ($leaderboard->rank === 'Silver')
                            <img src="{{ asset('imgs/badges/silver.png') }}"
                            alt="Silver Badge" class="clickable-photo" width="40" 
                            data-fullsize="{{ asset('imgs/badges/silver.png') }}"/>

                        @elseif ($leaderboard->rank === 'Gold')
                            <img src="{{ asset('imgs/badges/gold.png') }}"
                            alt="Gold Badge" class="clickable-photo" width="40" 
                            data-fullsize="{{ asset('imgs/badges/gold.png') }}"/>

                        @elseif ($leaderboard->rank === 'Diamond')
                            <img src="{{ asset('imgs/badges/diamond.png') }}"
                            alt="Diamond Badge" class="clickable-photo" width="40" 
                            data-fullsize="{{ asset('imgs/badges/diamond.png') }}"/>
                            
                        @endif
                    </div>
                </div>
                @endforeach

            </div>
        </content>
        </main>
    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html>
