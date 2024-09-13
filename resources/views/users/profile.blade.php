<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Profile</title>
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
                            <img src="{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png') }}" class="profile-photo" alt="Profile Picture">
                            <div class="profile-info">
                                <h2>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h2>
                                <h4>@<span>{{ Auth::user()->username }}</span></h4>
                                <div class="profile-badge">
                                    <span class="badge">{{ Auth::user()->accountType }}</span>
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
                                    <a href="account-settings" class="edit-profile-button">Edit Profile</a>
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
                        
                        @include('inclusions/profile/profilePosts')

                        @include('inclusions/createPostModal')

                        @include('inclusions/openComments')

                        @include('inclusions/profile/profileCommsReps')

                        @include('inclusions/profile/profileLikes')

                        @include('inclusions/profile/profileBookmarks')

                    </div>

                    <div id="followModal" class="followModal">
                        <div class="followModal-content">
                            <span class="close">&times;</span>
                            <h2 class="modal-title">Followers and Following</h2>
                            <div class="modal-nav">
                                <span id="followers-tab" class="active">Followers</span>
                                <span id="following-tab">Following</span>
                            </div>
                            <div class="search-bar">
                                <input type="text" placeholder="Search">
                            </div>
                            
                            <!-- Followers List -->
                            <ul id="followers-list" class="user-list">
                                @foreach($followers as $follower)
                                <li>
                                    <img src="{{ $follower->followerUser->userPhoto ? Storage::url($follower->followerUser->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Photo" class="user-profile-photo">
                                    <div class="user-info">
                                        <span class="fullname">{{ $follower->followerUser->firstName }} {{ $follower->followerUser->lastName }}</span>
                                    </div>
                                    <button class="follow-btn">Following</button>
                                </li>
                                @endforeach
                            </ul>
                    
                            <!-- Following List -->
                            <ul id="following-list" class="user-list" style="display: none;">
                                @foreach($following as $follow)
                                <li>
                                    <img src="{{ $follow->followedUser->userPhoto ? Storage::url($follow->followedUser->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Photo" class="user-profile-photo">
                                    <div class="user-info">
                                        <span class="fullname">{{ $follow->followedUser->firstName }} {{ $follow->followedUser->lastName }}</span>
                                    </div>
                                    <button class="follow-btn">Following</button>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    
                    
                    
            </content>
        </main>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const followersTab = document.getElementById('followers-tab');
    const followingTab = document.getElementById('following-tab');
    const followersList = document.getElementById('followers-list');
    const followingList = document.getElementById('following-list');
    
    const profileStatsDiv = document.querySelector('.profile-stats'); // Profile stats div
    const followModal = document.getElementById('followModal'); // Modal element
    const closeModal = document.querySelector('.followModal .close'); // Close button

    // By default, show followers and set the active tab
    followersTab.classList.add('active-tab');
    
    // Function to handle tab switching
    function showFollowers() {
        followersTab.classList.add('active-tab');
        followingTab.classList.remove('active-tab');
        followersList.style.display = 'block';
        followingList.style.display = 'none';
    }

    function showFollowing() {
        followersTab.classList.remove('active-tab');
        followingTab.classList.add('active-tab');
        followersList.style.display = 'none';
        followingList.style.display = 'block';
    }

    // Event listeners for switching tabs
    followersTab.addEventListener('click', function (e) {
        e.preventDefault();
        showFollowers();
    });

    followingTab.addEventListener('click', function (e) {
        e.preventDefault();
        showFollowing();
    });

    profileStatsDiv.addEventListener('click', function () {
        followModal.style.display = 'flex'; // Make the modal visible only when clicked
    });

    // Close modal when close button is clicked
    closeModal.addEventListener('click', function () {
        followModal.style.display = 'none'; // Hide the modal
    });

    // Close modal if user clicks outside the modal content
    window.addEventListener('click', function (event) {
        if (event.target === followModal) {
            followModal.style.display = 'none';
        }
    });
});

    </script>
    
    <script src="js/postandcomment.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/profile.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>
