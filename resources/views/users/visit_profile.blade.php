<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | {{ $user->firstName }} {{ $user->lastName }}</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/profile_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/otherstyles/posts_style.css') }}">
    @include('inclusions/libraryLinks')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        @include('inclusions/userNav')
        <main>
            <header>
                <div class="header-top">
                    <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="Lawminary Logo">
                    <div class="notification">
                        <a href="notifications"><i class="fas fa-bell bell-icon"></i></a>
                    </div>
                </div>
                <hr class="divider">
            </header>

            <content class="profile-section">
                <div class="profile-header">
                    <div class="profile-details">
                        <div class="profile-left">
                            <img src="{{ $user->userPhoto ? Storage::url($user->userPhoto) : '../../imgs/user-img.png' }}" class="profile-photo" alt="Profile Picture">
                            <div class="profile-info">
                                <h2>{{ $user->accountType === 'Attorney' ? 'Atty. ' : '' }}{{ $user->firstName }} {{ $user->lastName }}</h2>
                                <h4>@<span>{{ $user->username }}</span></h4>
                                <div class="profile-badge">
                                    <span class="badge">{{ $user->accountType }}</span>
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
                                <form action="{{ route('followUser') }}" method="POST" style="display:inline;">
                                    @csrf
                                    @include('inclusions/response')
                                    <input type="hidden" name="following" value="{{ $user->user_id }}">
                                    
                                    <button class="edit-profile-button">
                                        {{ $haveFollowed ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                <div class="profile-nav">
                    <ul>
                        <li><a id="posts-link">Posts</a></li>
                        <li><a id="comments-link">Comments and Replies</a></li>
                        <li><a id="liked-link">Likes</a></li>
                        <li><a id="bookmarked-link">Bookmarks</a></li>
                    </ul>
                </div>
                <hr>
                <div class="profile-content">

                    @include('inclusions/profile/profileFollowModal')
                    
                    @include('inclusions/profile/profilePosts')
    
                    @include('inclusions/openComments')
    
                    @include('inclusions/profile/profileCommsReps')
    
                    @include('inclusions/profile/profileLikes')
    
                    @include('inclusions/profile/profileBookmarks')

                </div>
            </content>
        </main>
    </div>
    <script src="js/followModal.js"></script>
    <script src="/js/postandcomment.js"></script>
    <script src="/js/settings.js"></script>
    <script src="/js/profile.js"></script>
    <script src="/js/logout.js"></script>
</body>
</html>