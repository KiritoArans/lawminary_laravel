<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lawminary | Home</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/home_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/otherstyles/posts_style.css') }}" />
    @include('inclusions/libraryLinks')
</head>
<body>
    <div class="container">
        @include('inclusions/userNav')
        <main>
            <header>
                <div class="header-top">
                    {{-- <i class="fa-solid fa-bars" style="font-size: 1.5rem"></i> --}}
                    @include('includes_syscon.syscon_logo_inc')
                    <div class="notification">
                        <a href="notifications">
                            <i class="fas fa-bell bell-icon"></i>
                        </a>
                    </div>
                </div>
                <hr class="divider" />
            </header>
            <div class="header-buttons-search">
                <div class="header-buttons">
                    <button id="postsTab" class="posts-tab current-tab">Posts</button>
                    <button id="forumsTab" class="forums-tab">Forums</button>
                    <button id="articlesTab" class="articles-tab">Article</button>
                </div>

                <div class="search-bar">
                    <form id="searchForm" action="/home-search" method="GET">
                        <input type="text" name="query" id="searchQuery" placeholder="Search a user or post" required />
                        <i class="fas fa-search search-icon" onclick="document.getElementById('searchForm').submit();"></i>
                        <button type="submit">Search</button>
                    </form>
                </div>

            </div>
            <content>
                <div class="filter-post">
                    <form action="{{ route('home') }}" method="GET" class="filter-form">
                        <select name="filter" id="filter" onchange="this.form.submit()">
                            <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Discover</option>
                            <option value="following" {{ request('filter') == 'following' ? 'selected' : '' }}>Following</option>
                        </select>
                    </form>
                </div>
                
                @include('inclusions/showPosts')
                    
                @include('inclusions/openComments')
                
                @include('inclusions/createPostModal')

                @include('inclusions/rateCommentModal')

                @include('inclusions/reportPostModal')

            </content>
        </main>
    </div>

    <script src="js/postandcomment.js"></script>
    <script src="js/likePost.js"></script>
    <script src="js/bookmarkPost.js"></script>
    <script src="js/commentPost.js"></script>
    <script src="js/replyPost.js"></script>

    <script src="js/reportPost.js"></script>

    <script src="js/followUser.js"></script>

    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>
