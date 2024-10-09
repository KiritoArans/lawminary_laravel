<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Profile</title>
        <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png" />
        <link rel="stylesheet" href="{{ asset('css/profile_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('css/otherstyles/posts_style.css') }}"
        />
        @include('inclusions/libraryLinks')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="notifications">
                                <i class="fas fa-bell bell-icon"></i>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>

                <content class="profile-section">
                    <div class="profile-header">
                        <div class="profile-details">
                            <div class="profile-left">
                                <img
                                    src="{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png') }}"
                                    class="profile-photo"
                                    alt="Profile Picture"/>
                                <div class="profile-info">
                                    <h2>
                                        {{ Auth::user()->firstName }}
                                        {{ Auth::user()->lastName }}
                                    </h2>
                                    <h4>
                                        @<span>{{ Auth::user()->username }}</span>
                                    </h4>
                                    <div class="profile-badge">
                                        <span class="badge">
                                            {{ Auth::user()->accountType }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="profile-right">
                                <div class="profile-stats">
                                    <div class="following-count">
                                        <span>Following:</span>
                                        <span>{{ $followingCount }}</span>
                                    </div>
                                    <div class="follower-count">
                                        <span>Followers:</span>
                                        <span>{{ $followerCount }}</span>
                                    </div>
                                    <a href="account-settings" class="edit-profile-button">
                                        Edit Profile
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="hr1">
                    <div class="profile-nav">
                        <ul>
                            <li id="posts-link"><a >Posts</a></li>
                            <li id="comments-link"><a >Comments and Replies</a></li>
                            <li id="liked-link"><a>Likes</a></li>
                            <li id="bookmarked-link"><a>Bookmarks</a></li>
                        </ul>
                    </div>
                    <hr class="hr2">

                    <div class="profile-content">

                        @include('inclusions/profile/profileFollowModal')

                        @include('inclusions/profile/profilePosts')

                        @include('inclusions/openComments')

                        @include('inclusions/rateCommentModal')

                        @include('inclusions/profile/profileCommsReps')

                        @include('inclusions/profile/profileLikes')

                        @include('inclusions/profile/profileBookmarks')

                    </div>

                    @include('inclusions/profile/penPostModal')
                    
                    @include('inclusions/createPostModal')

                </content>
            </main>
        </div>
        <script src="js/followModal.js"></script>
        <script src="js/postandcomment.js"></script>

        <script src="js/likePost.js"></script>
        <script src="js/bookmarkPost.js"></script>
        <script src="js/commentPost.js"></script>
        <script src="js/replyPost.js"></script>

        <script src="js/followUser.js"></script>
        
        <script src="js/pendingPost.js"></script>

        <script src="js/settings.js"></script>
        <script src="js/profile.js"></script>
        <script src="js/logout.js"></script>
    </body>
</html>
