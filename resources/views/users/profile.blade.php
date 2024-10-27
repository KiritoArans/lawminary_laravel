<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Profile</title>
        <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
        <link rel="stylesheet" href="{{ asset('css/profile_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('css/otherstyles/posts_style.css') }}"
        />
        @include('inclusions/libraryLinks')
        @include('inclusions/broadcastJS')
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
                            <a href="notifications" class="notification-link">
                                <i class="fas fa-bell bell-icon current"></i>
                                <span id="notification-count" class="notification-badge"></span>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>

                <content >
                    <div class="profile-section">
                        <div class="profile-header">
                            <div class="profile-details">
                                <div class="profile-left">
                                    <img
                                        src="{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png') }}"
                                        class="profile-photo"
                                        alt="Profile Picture"
                                        onclick="openModal()"/>
                                    <div class="profile-info">
                                        <div class="profile-names">
                                            <h2>
                                                {{ $user->accountType === 'Lawyer' ? 'Atty. ' : '' }}
                                                {{ $user->firstName }} {{ $user->lastName }}
                                            </h2>
                                            @if ($user->accountType === 'Lawyer' && $rank != 'No Rank') 
                                                <a href="/leaderboards">
                                                    <img src="{{ asset('imgs/badges/' . strtolower($rank) . '.png') }}" 
                                                        alt="{{ ucfirst($rank) }} Badge" 
                                                        width="10" class="badge-rank" 
                                                        title="{{ ucfirst($rank) }} Badge">
                                                </a>
                                            @endif
                                        </div>
                                        <h4>@<span>{{ $user->username }}</span></h4>
                                        <div class="profile-badge">
                                            <span class="badge">
                                                {{ $user->accountType }}{{ $user->accountType === 'Lawyer' ? ' | ' . $averageRating : '' }}
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
                                <li id="comments-link"><a >Comments</a></li>
                                <li id="liked-link"><a>Likes</a></li>
                                <li id="bookmarked-link"><a>Bookmarks</a></li>
                            </ul>
                        </div>
                    
                    </div>



                    <div class="profile-content">

                        @include('inclusions/profile/profileFollowModal')

                        @include('inclusions/profile/profilePosts')

                        @include('inclusions/openComments')

                        @include('inclusions/rateCommentModal')

                        @include('inclusions/profile/profileCommsReps')

                        @include('inclusions/profile/profileLikes')

                        @include('inclusions/profile/profileBookmarks')

                        @include('inclusions/reportPostModal')

                    </div>

                    @include('inclusions/profile/penPostModal')
                    
                    @include('inclusions/createPostModal')

                    <div id="profileModal" class="profileModal">
                        <div class="profileModal-content">
                            <span class="profileModal-close" onclick="closeModal()"><i class="fa-regular fa-circle-xmark"></i></span>
                            <img
                                src="{{ $user->userPhoto ? Storage::url($user->userPhoto) : asset('imgs/user-img.png') }}"
                                alt="Profile Picture"
                                style="width: 100%; height: auto;" />
                        </div>
                    </div>

                </content>
            </main>
        </div>
        <script src="js/followModal.js"></script>
        <script src="js/postandcomment.js"></script>

        <script src="js/likePost.js"></script>
        <script src="js/bookmarkPost.js"></script>
        <script src="js/commentPost.js"></script>
        <script src="js/replyPost.js"></script>
        <script src="js/rateComment.js"></script>

        <script src="js/followUser.js"></script>

        <script src="js/reportPost.js"></script>
        
        <script src="js/pendingPost.js"></script>

        <script src="js/showNotification.js"></script>
        
        <script src="js/settings.js"></script>
        <script src="js/profile.js"></script>
        <script src="js/logout.js"></script>

    </body>
</html>
