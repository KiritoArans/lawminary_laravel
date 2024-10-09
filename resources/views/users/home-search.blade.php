<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lawminary | Search for {{ $query }}</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
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
                    <button id="postsTab" class="posts-tab">Posts</button>
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
                <div class="search-results">

                    <!-- Navigation Tabs -->
                    <div class="home-search-nav">
                        <span id="all-tab" class="active">All</span>
                        <span id="user-tab">User</span>
                        <span id="post-tab">Post</span>
                    </div>
                    
                    <!-- Users Section -->
                    <div id="user-section">
                        <h3>Users</h3>
                        @if ($users->isEmpty())
                            <p class="empty-search">No user found for {{$query}}.</p>
                        @else
                            @foreach ($users as $user)
                            <div class="user-searched">
                                <div class="user-details">
                                    <img src="{{ $user->userPhoto ? Storage::url($user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo" />
                                    <div class="user-names">
                                        <a href="{{ Auth::check() && Auth::user()->user_id == $user->user_id ? route('profile') : route('visit-profile', ['user_id' => $user->user_id]) }}">
                                            {{ $user->firstName }} {{ $user->lastName }}
                                        </a>
                                        <p>@<span>{{ $user->username }}</span></p>
                                        <span>{{ $user->posts_count }} Posts, {{ $user->followers_count }} Followers</span>
                                    </div>
                                </div>
                                @php
                                    $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)
                                        ->where('following', $user->user_id)
                                        ->exists();
                                @endphp
                
                                @if (Auth::check() && Auth::user()->user_id !== $user->user_id)
                                    <form class="follow-form" action="{{ route('followUser') }}" method="POST" style="display: inline">
                                        @csrf
                                        <input type="hidden" name="following" value="{{ $user->user_id }}">

                                        <button type="submit" class="edit-profile-button follow-btn {{ $haveFollowed ? 'following followed-btn' : '' }}">
                                            {{ $haveFollowed ? 'Unfollow' : 'Follow' }}
                                        </button>
                                    </form>
                                @endif

                            </div>
                            @endforeach
                        @endif
                    </div>
                
                    <!-- Posts Section -->
                    <div id="post-section">
                        <h3>Posts</h3>
                        @if ($posts->isEmpty())
                            <p class="empty-search">No post found for {{$query}}.</p>
                        @else
                            @include('inclusions/showPosts')
                        @endif
                    </div>
                
                </div>
                


            </content>

            @include('inclusions/openComments')

            @include('inclusions/createPostModal')

            @include('inclusions/rateCommentModal')

            @include('inclusions/reportPostModal')
        </main>
    </div>
    
    <script src="js/homeSearchNav.js"></script>

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
