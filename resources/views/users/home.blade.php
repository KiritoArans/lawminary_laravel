<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Home</title>
    <link rel="icon" href="../imgs/lawminarylogo.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/home_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/otherstyles/posts_style.css') }}">
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
                    @foreach($posts as $post)
                        <div class="post-content">
                            <div class="post-header">
                                <div class="user-info">
                                    @if($post->user)
                                        <img src="{{ $post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo">
                                        <div class="post-info">
                                            <h2>{{ $post->user->firstName }} {{ $post->user->lastName }}</h2>
                                            <p>@<span>{{ $post->user->username }}</span></p>
                                        </div>
                                    @else
                                        <img src="../imgs/user-img.png" alt="Default Profile Picture" class="user-profile-photo">
                                        <div class="post-info">
                                            <h2>Unknown User</h2>
                                            <p>@unknown</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="post-options">
                                    <div class="options">
                                        <a href="#">Action</a>
                                        <a href="#">Report</a>
                                    </div>
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                            </div>
                            <hr>
                            <div class="post-text">
                                <p>{{ $post->concern }}</p>
                                @if($post->concernPhoto)
                                    <img src="{{ Storage::url($post->concernPhoto) }}" alt="Post Image" style="max-width: 100%; height: auto;">
                                @endif
                            </div>
                            <hr>
                            <div class="actions">
                                <button><i class="fa-solid fa-gavel"></i> Hit</button>
                                <button class="btn-comment" data-post-id="{{ $post->post_id }}">
                                    <i class="fas fa-comment"></i> Comment
                                </button>
                                <button><i class="fas fa-bookmark"></i> Bookmark</button>
                            </div>
                        </div>
                       
                        
                        <div class="comment-modal" id="commentModal-{{ $post->post_id }}" style="display:none;">
                            <div class="clicked-post-content">
                                <div class="clicked-post-header">
                                    <div class="user-info">
                                        @if($post->user)
                                            <img src="{{ $post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo">
                                            <div class="clicked-post-info">
                                                <h2 id="modalUserName">{{ $post->user->firstName }} {{ $post->user->lastName }}</h2>
                                                <p>@<span id="modalUserUsername">{{ $post->user->username }}</span></p>
                                            </div>
                                        @else
                                            <img src="../imgs/user-img.png" alt="Default Profile Picture" class="user-profile-photo">
                                            <div class="clicked-post-info">
                                                <h2>Unknown User</h2>
                                                <p>@unknown</p>
                                            </div>
                                        @endif
                                        
                                    </div>
                                </div>
                                <hr>
                                <div class="clicked-post-text">
                                    <p id="modalPostText">{{ $post->concern }}</p>
                                    @if ($post->concernPhoto)
                                        <img id="modalPostPhoto" src="{{ Storage::url($post->concernPhoto) }}" alt="Concern Photo" style="max-width: 100%; height: auto;">
                                    @endif
                                </div>
                                <hr>
                                <div class="actions">
                                    <button><i class="fa-solid fa-gavel"></i> Hit</button>
                                    <button><i class="fas fa-comment"></i> Comment</button>
                                    <button><i class="fas fa-bookmark"></i> Bookmark</button>
                                </div>
            
                                <hr>
            
                                <div class="comment-section">
                                    <div class="comment-area">
                                        @foreach($post->comments as $comment)
                                        <div class="user-comment">
                                                <div>
                                                @if($comment->user && $comment->user->userPhoto)
                                                    <img src="{{ Storage::url($comment->user->userPhoto) }}" alt="User Profile Picture" class="user-profile-photo">
                                                @else
                                                <img src="../../imgs/user-img.png" alt="Default User Image" class="user-profile-photo">
                                                @endif
                                                </div>
                                                <div>
                                                    <span>{{ $comment->user ? $comment->user->firstName . ' ' . $comment->user->lastName : 'Unknown User' }}</span>
                                                    <p>{{ $comment->comment }}</p>
                                                </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <hr>
                                    <div class="comment-field">
                                        <form id="commentForm" method="POST" action="{{ route('users.createComment') }}">
                                            @csrf
                                            @if(Auth::user()->userPhoto)
                                                <img src="{{ Storage::url(Auth::user()->userPhoto) }}" class="user-profile-photo" alt="Profile Picture">
                                            @else
                                                <img src="../../imgs/user-img.png" class="user-profile-photo" alt="Profile Picture">
                                            @endif
                                            <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                                            <textarea name="comment" placeholder="Write a comment..." required></textarea>
                                            <button type="submit">Send</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @include('inclusions/createPostModal')
            </content>
        </main>
    </div>

    
    <script src="js/postandcomment.js"></script>
    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/logout.js"></script>
</body>
</html>
