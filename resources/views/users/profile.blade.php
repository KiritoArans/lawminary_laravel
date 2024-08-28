<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Profile</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/profile_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <aside>
            <div class="top-nav">
                <div class="profile">
                    <div class="user-indicator">
                        <img src="../imgs/user-img.png" alt="Profile Picture">
                        <label>@Username</label>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li><a href="home"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
                        <li><a href="search"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a></li>
                        <li><a href="resources"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                        <li><a href="profile" class="current" ><i class="fa-solid fa-user"></i><span>Profile</span></a></li>
                        <li>
                            <a onclick="toggleDropdown(event)"><i class="fa-solid fa-gear"></i><span>Settings</span></a>
                            <div id="settingsDropdown" class="dropdown-content">
                                <ul>
                                    <li><a href="settings/lawminary">About Lawminary</a></li>
                                    <li><a href="settings/pao">About PAO</a></li>
                                    <li><a href="settings/account">Account Settings</a></li>
                                    <li><a href="settings/activitylogs">Activity Logs</a></li>
                                    <li><a href="settings/feedback">Provide Feedback</a></li>
                                    <li><a href="settings/tos">Terms of Service</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="bottom-nav">
                <a class="logout" href="login"><i class="fa-solid fa-right-from-bracket"></i><span>Log out</span></a>
            </div>
        </aside>
        
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
                                <img src="../imgs/user-img.png" alt="Profile Picture" class="profile-pic">
                                <div class="profile-info">
                                    <h2>Firstname Lastname</h2>
                                    <h4>@username</h4>
                                    <div class="profile-badge">
                                        <span class="badge">User</span>
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
                                    <a href="settings/account_settings.html" class="edit-profile-button">Edit Profile</a>
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
                    <div class="profile-posts">
                        <div class="posts">
                            <div class="post-content">
                                <div class="post-header">
                                    <div class="user-info">
                                        <img src="../imgs/user-img.png" alt="Profile Picture" class="profile-pic">
                                        <div class="post-info">
                                            <h2>Name Surname</h2>
                                            <p>@username</p>
                                        </div>
                                    </div>
                                    <div class="post-options">
                                        <div class="options">
                                            <a href="">Delete</a>
                                            <a href="">Report</a>
                                        </div>
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
                   <div class="profile-comments">
                        <div class="comments">
                            <div class="comment-content">
                                <div class="comment-header">
                                    <div class="user-info">
                                        <img src="../imgs/user-img.png" alt="Profile Picture" class="profile-pic">
                                        <div class="comment-info">
                                            <h2>Name Surname</h2>
                                            <p>@username</p>
                                        </div>
                                    </div>
                                        <div class="comment-options">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </div>
                                </div>
                                <hr>
                                <div class="comment-text">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                                <hr>
                                <div class="actions">
                                    <button><i class="fa-solid fa-gavel"></i> Hit</button>
                                    <button><i class="fas fa-comments"></i> Reply</button>
                                    <button><i class="fas fa-bookmark"></i> Bookmark</button>
                                </div>
                            </div>
                        </div>
                   </div>
                   <div class="profile-liked">
                        <div class="posts">
                            <div class="post-content">
                                <div class="post-header">
                                    <div class="user-info">
                                        <img src="../imgs/user-img.png" alt="Profile Picture" class="profile-pic">
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
                                        <img src="../imgs/user-img.png" alt="Profile Picture" class="profile-pic">
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
    <script src="../js/settings.js"></script>
    <script src="../js/home_js.js"></script>
    <script src="../js/profile.js"></script>
</body>
</html>
