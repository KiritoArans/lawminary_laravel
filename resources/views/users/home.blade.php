<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Home</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/home_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="{{ asset('js/library_js/sweetalertV2.js') }}"></script>
</head>
<body>
    <div class="container">
        <aside>
            <div class="top-nav">
                <div class="profile">
                    <div class="user-indicator">
                        @if(Auth::user()->userPhoto)
                            <img src="{{ Storage::url(Auth::user()->userPhoto) }}" alt="Profile Picture">
                        @else
                            <img src="../../imgs/user-img.png" alt="Profile Picture">
                        @endif
                        <label>@<span>{{ Auth::user()->username }}</span></label>
                    </div>
                </div>                
                <nav>
                    <ul>
                        <li><a href="home" class="current"><i class="fa-solid fa-house"></i><span>Home</span></a></li>
                        <li><a href="search"><i class="fa-solid fa-magnifying-glass"></i><span>Search</span></a></li>
                        <li><a href="resources"><i class="fa-solid fa-folder"></i><span>Resources</span></a></li>
                        <li><a href="profile"><i class="fa-solid fa-user"></i><span>Profile</span></a></li>
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
                <a class="logout" id="logout-link">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Log out</span>
                </a>
                
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </aside>
        
        <main>
            <header>
                <div class="header-top">
                    <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
                    <div class="notification">
                        <a href="notifications"><i class="fas fa-bell bell-icon"></i></a>
                    </div>
                </div>
                <hr class="divider">
                <div class="header-buttons-search">
                    <div class="header-buttons">
                        <button id="postsTab" class="posts-tab current-tab">Posts</button>
                        <button id="forumsTab" class="forums-tab">Forums</button>
                        <button id="articlesTab" class="articles-tab">Article</button>
                    </div> 
                    <div class="search-bar">
                        <input type="text" placeholder="Search a user or post">
                        <i class="fas fa-search search-icon"></i>
                    </div>
                </div>
            </header>
            <content>
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
                                    <a href="">Action</a>
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
                <div class="new-post">
                    <i class="fas fa-edit"></i>
                </div>
            </content>
        </main>
    </div>

    <div id="postModal" class="post-modal">
        <div class="post-modal-content">
            <span class="close">&times;</span>

            <form action="{{ route('users.createPost') }}" method="POST" enctype="multipart/form-data">
                @csrf 
                <div class="post-header">
                    <img src="../imgs/user-img.png" alt="Profile Picture" class="post-profile-pic">
                    <div class="post-modal-info">
                        <h2>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h2>
                        <p>@<span>{{ Auth::user()->username }}</span></p>
                    </div>                
                </div>
                <div class="post-modal-text">
                    <textarea name="concern" placeholder="Ask concerns..." required></textarea>
                </div>
                <div class="post-modal-footer">
                    <label for="file-upload" class="custom-file-upload">
                        <i class="fa-solid fa-file-arrow-up"></i>
                    </label>
                    <input id="file-upload" type="file" name="concernPhoto" style="display: none;">
                    {{-- <input type="file" name="concernPhoto" id=""> --}}
                    <p>Note: The post will be reviewed first prior to the approval of the moderators to make sure that it follows a certain measure of decency.</p>
                    <button type="submit" class="post-button">Post</button>
                </div>
            </form>
            
        </div>
    </div>   
    <script src="../js/home_js.js"></script>
    <script src="../js/locator.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/oneforall.js"></script>
</body>
</html>
