<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Forums</title>
        <link rel="icon" href="/imgs/lawminarylogo_v3.png" type="image/png" />
        <link rel="stylesheet" href="{{ asset('css/forums_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/responsive/navres.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('css/otherstyles/posts_style.css') }}"
        />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        <i class="fa-solid fa-bars"></i>
                        <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="" />
                        <div class="notification">
                            <a href="notifications" class="notification-link">
                                <i class="fas fa-bell bell-icon current"></i>
                                <span id="notification-count" class="notification-badge"></span>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>

                <div class="header-buttons-search">
                    <div class="header-buttons">
                        <button id="postsTab" class="posts-tab">
                            <span>Posts</span>
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </button>
                        <button id="forumsTab" class="forums-tab current-tab">
                            <span>Forums</span>
                            <i class="fa-solid fa-users"></i>
                        </button>
                        <button id="articlesTab" class="articles-tab">
                            <span>Articles</span>
                            <i class="fa-solid fa-scale-balanced"></i>
                        </button>
                        <button id="leaderboardsTab" class="leaderboards-tab">
                            <span>Top Lawyers</span>
                            <i class="fa-solid fa-chart-simple"></i>
                        </button>
                    </div>
                    <button id="showForumLists">See Forum Lists</button>
                </div>

                <div class="content-wrapper">
                    <div class="forum-left">
                        <div class="search-forum">
                            <div class="search-ttl">
                                <label>Discover</label>
                                <label>Forums</label>
                            </div>
                            <input
                                type="text"
                                id="searchInput"
                                placeholder="Search forums..."
                            />
                            <button>Search</button>
                        </div>

                        @foreach ($discoverForum as $dForum)
                            <div class="forum-overview forum-item">
                                <section class="forum-section">
                                    <div class="forum-active">
                                        <div class="circle">
                                            <img
                                                class="images"
                                                src="{{ Storage::url($dForum->forumPhoto) }}"
                                                alt="{{ $dForum->forumName }}"
                                            />
                                        </div>
                                        <div class="forum-details">
                                            <a
                                                href="{{ route('visit.forum', $dForum->forum_id) }}"
                                                class="forum-link"
                                            >
                                                <h2 class="forum-name">
                                                    {{ $dForum->forumName }}
                                                </h2>
                                            </a>
                                            <p>
                                                {{ $dForum->membersCount }}
                                                Member(s)
                                            </p>
                                            <p>{{ $dForum->forumDesc }}</p>
                                            <input
                                                type="hidden"
                                                id="forumIdInput"
                                                value="{{ $dForum->forum_id }}"
                                                readonly
                                            />
                                        </div>
                                    </div>

                                    <form
                                        action="{{ route('forum.join') }}"
                                        method="POST"
                                    >
                                        @csrf
                                        @include('inclusions/response')
                                        <input
                                            type="hidden"
                                            name="forum_id"
                                            value="{{ $dForum->forum_id }}"
                                        />
                                        <button
                                            class="join-button {{ $joined[$dForum->forum_id] ? 'joined-button' : '' }}"
                                            type="submit"
                                        >
                                            {{ $joined[$dForum->forum_id] ? 'Joined' : 'Join' }}
                                        </button>
                                    </form>
                                </section>
                            </div>
                        @endforeach
                    </div>

                    <div class="forum-invitations-wrapper">
                        <section class="forum-invitations">
                            <div class="forum-ttl">
                                <h2>Forum List</h2>
                            <i class="fa-solid fa-window-minimize" id="minimizeIcon"></i>
                            </div>              
                            <div class="search-bar">
                                <i class="fas fa-search search-icon"></i>
                                <input type="text" placeholder="Search Forums">
                            </div>
                      
                            @foreach($joinedForum as $forum)
                                <a href="{{ route('visit.forum', $forum->forum_id) }}" class="forum-link">
                                    <div class="forum" 
                                        data-forum-id="{{ $forum->forum_id }}"
                                        data-forum-name="{{ $forum->forumName }}"
                                        data-forum-members="{{ $forum->membersCount ?? 0 }}"
                                        data-forum-desc="{{ $forum->forumDesc }}"
                                        data-forum-photo="{{ Storage::url($forum->forumPhoto) }}">
                                        <img src="{{ Storage::url($forum->forumPhoto) }}" alt="">
                                    <div class="forum-status">
                                        <span>Joined</span>
                                    </div>
                                    <div class="forum-head">
                                        <h3>{{ $forum->forumName }}</h3>
                                        <h5>Member(s): {{ $forum->membersCount ?? 0 }}</h5>
                                    </div>
                                    </div>
                                </a>
                            @endforeach
                    
                        </section>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <script src="js/showUserNav.js"></script>

        <script src="js/showNotification.js"></script>
        <script src="js/user_js/forums.js"></script>
        <script src="js/homelocator.js"></script>
        <script src="js/settings.js"></script>
        <script src="js/logout.js"></script>
        <script src="js/postandcomment.js"></script>
    </body>
</html>
