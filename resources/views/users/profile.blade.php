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
                                @if(Auth::user()->userPhoto)
                                    <img src="{{ Storage::url(Auth::user()->userPhoto) }}" class="profile-photo" alt="Profile Picture">
                                @else
                                    <img src="../../imgs/user-img.png" class="profile-photo" alt="Profile Picture">
                                @endif
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
                                        <span>0</span>
                                    </div>
                                    <div class="follower-count">
                                        <span>Followers:</span>
                                        <span>0</span>
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
                        <li><a id="liked-link">Liked</a></li>
                        <li><a id="bookmarked-link">Bookmarked</a></li>
                    </ul>
                </div>
                <hr>
                <div class="profile-content">
                    
                    @include('inclusions/profilePosts')

                    @include('inclusions/createPostModal')
                    
                    @include('inclusions/profileCommsReps')

                   <div class="profile-liked">
                        <div class="posts">
                            <div class="post-content">
                                <div class="post-header">
                                    <div class="user-info">
                                        <img src="../imgs/user-img.png" alt="Profile Picture" class="user-profile-photo">
                                        <div class="post-info">
                                            <h2>Name Surname</h2>
                                            <p>@username</p>
                                        </div>
                                    </div>
                                        <div class="post-options">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </div>
                                </div>
                                <hr>
                                <div class="post-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                                <hr>
                                <div class="actions">
                                    <button><i class="fa-solid fa-gavel"></i> Hit</button>
                                    <button><i class="fas fa-comment"></i> Comment</button>
                                    <button><i class="fas fa-bookmark"></i> Bookmark</button>
                                </div>
                            </div>
                        </div>
                   </div>

                   <div class="profile-bookmarked">
                        <div class="posts">
                            <div class="post-content">
                                <div class="post-header">
                                    <div class="user-info">
                                        <img src="../imgs/user-img.png" alt="Profile Picture" class="user-profile-photo">
                                        <div class="post-info">
                                            <h2>Name Surname</h2>
                                            <p>@username</p>
                                        </div>
                                    </div>
                                        <div class="post-options">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </div>
                                </div>
                                <hr>
                                <div class="post-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                                <hr>
                                <div class="actions">
                                    <button><i class="fa-solid fa-gavel"></i> Hit</button>
                                    <button><i class="fas fa-comment"></i> Comment</button>
                                    <button><i class="fas fa-bookmark"></i> Bookmark</button>
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </content>
        </main>
    </div>

    <script src="js/postandcomment.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/profile.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>
