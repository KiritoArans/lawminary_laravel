<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | {{ $user->firstName }} {{ $user->lastName }}</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/profile_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive/navres.css') }}" />
    <link rel="stylesheet" href="{{ asset ('css/otherstyles/posts_style.css') }}">
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
                    <i class="fa-solid fa-bars"></i>
                    <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="Lawminary Logo">
                    <div class="notification">
                        <a href="notifications" class="notification-link">
                            <i class="fas fa-bell bell-icon current"></i>
                            <span id="notification-count" class="notification-badge"></span>
                        </a>
                    </div>
                </div>
                <hr class="divider">
            </header>

            <content>
                
                <div class="profile-section">
                    <div class="profile-header">
                        <div class="profile-details">
                            <div class="profile-left">
                                <img src="{{ $user->userPhoto ? Storage::url($user->userPhoto) : '../../imgs/user-img.png' }}" 
                                        class="profile-photo" alt="Profile Picture"
                                        onclick="openModal()" >
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
                                        <span class="badge" id="openHelpedModal">
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
                                    @php
                                        $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)
                                            ->where('following', $user->user_id)
                                            ->exists();
                                    @endphp

                                    <form class="follow-form" action="{{ route('followUser') }}" method="POST" style="display: inline">
                                        @csrf
                                        <input type="hidden" name="following" value="{{ $user->user_id }}">
                                        
                                        <button type="submit" class="edit-profile-button" class="follow-btn {{ $haveFollowed ? 'following' : '' }}">
                                            {{ $haveFollowed ? 'Unfollow' : 'Follow' }}
                                        </button>
                                    </form>

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
                    
                    <div class="profile-posts">
                        @if ($vPosts->isEmpty())
                            <div class="empty">No posts yet.</div>
                        @endif

                        @foreach ($vPosts as $post)
                            @include('inclusions/profile/profilePosts')
                        @endforeach
                    </div>
    
                    @include('inclusions/openComments')
                    
                    @include('inclusions/rateCommentModal')
    
                    @include('inclusions/profile/profileCommsReps')
    
                    <div class="profile-liked">
                        @if($likes->isEmpty())
                            <div class="empty">No likes yet.</div>
                        @endif

                        @foreach($likes as $post)
                            @include('inclusions/profile/profilePosts')
                        @endforeach
                    </div>

                    <div class="profile-bookmarked">
                        @if($bookmarks->isEmpty())
                            <div class="empty">No bookmarks yet.</div>
                        @endif

                        @foreach($bookmarks as $post)
                            @include('inclusions/profile/profilePosts')
                        @endforeach
                    </div>

                    @include('inclusions/reportPostModal')

                    @include('inclusions/profile/userHelpedCount')

                    <div id="profileModal" class="profileModal">
                        <div class="profileModal-content">
                            <span class="profileModal-close" onclick="closeModal()"><i class="fa-regular fa-circle-xmark"></i></span>
                            <img
                                src="{{ $user->userPhoto ? Storage::url($user->userPhoto) : asset('imgs/user-img.png') }}"
                                alt="Profile Picture"
                                style="width: 100%; height: auto;" />
                        </div>
                    </div>

                </div>
            </content>
        </main>
    </div>
    <script src="js/followModal.js"></script>
    <script src="/js/postandcomment.js"></script>

    <script src="js/likePost.js"></script>
    <script src="js/bookmarkPost.js"></script>
    <script src="js/commentPost.js"></script>
    <script src="js/replyPost.js"></script>
    <script src="js/rateComment.js"></script>
    
    <script src="js/followUser.js"></script>

    <script src="js/reportPost.js"></script>

    <script src="js/showNotification.js"></script>

    <script src="js/showUserNav.js"></script>
    <script src="/js/settings.js"></script>
    <script src="/js/profile.js"></script>
    <script src="/js/logout.js"></script>
</body>
</html>