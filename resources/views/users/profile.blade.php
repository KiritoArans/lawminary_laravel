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
    <script src="{{ asset('js/library_js/sweetalertV2.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                                @if(Auth::user()->userPhoto)
                                    <img src="{{ Storage::url(Auth::user()->userPhoto) }}" class="user-profile-photo" alt="Profile Picture">
                                @else
                                    <img src="../../imgs/user-img.png" class="user-profile-photo" alt="Profile Picture">
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
                                    <a href="settings/account" class="edit-profile-button">Edit Profile</a>
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
                            @foreach($posts as $post)
                                @if($posts->isEmpty())
                                    <p>No posts yet.</p>
                                @endif
                                <div class="post-content">
                                    <div class="post-header">
                                        <div class="user-info">
                                            @if(Auth::user()->userPhoto)
                                                <img src="{{ Storage::url(Auth::user()->userPhoto) }}" class="user-profile-photo" alt="Profile Picture">
                                            @else
                                                <img src="../../imgs/user-img.png" class="user-profile-photo" alt="Profile Picture">
                                            @endif
                                            <div class="post-info">
                                                <h2>{{ $user->firstName }} {{ $user->lastName }}</h2>
                                                <p>@<span>{{ $user->username }}</span></p>
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
                                        <p>{{ $post->concern }}</p>
                                        @if ($post->concernPhoto)
                                            <img src="{{ Storage::url($post->concernPhoto) }}" alt="Concern Photo" style="max-width: 25%; height: auto;">
                                        @endif
                                    </div>
                                    <hr>
                                    <div class="actions">
                                        <button><i class="fa-solid fa-gavel"></i> Hit</button>
                                        <button class="btn-comment" data-post-id="{{ $post->post_id }}">
                                            <i class="fas fa-comment"></i>Comment
                                        </button>
                                        <button><i class="fas fa-bookmark"></i> Bookmark</button>
                                    </div>
                                </div>
                            @endforeach
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

    <!-- Comment Modal Structure -->
    <div class="comment-modal" id="commentModal">
        <div class="clicked-post-content">
            <div class="clicked-post-header">
                <div class="user-info">
                    <img id="modalUserPhoto" class="user-profile-photo" alt="Profile Picture">
                    <div class="clicked-post-info">
                        <h2 id="modalUserName"></h2>
                        <p>@<span id="modalUserUsername"></span></p>
                    </div>
                </div>
            </div>

            <hr>

            <div class="clicked-post-text">
                <p id="modalPostText"></p>
                <img id="modalPostPhoto" style="display:none; max-width: 100%; height: auto;">
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
                    {{-- @foreach($post->comments as $comment)
                    <div class="comment">
                        @if($comment->user)
                            <p>{{ $comment->user->username }}: {{ $comment->comment }}</p>
                        @else
                            <p><em>Unknown User</em>: {{ $comment->comment }}</p>
                        @endif
                    </div>
                    @endforeach --}}
                </div>
                
                <hr>
                <div class="comment-field">
                    <form id="commentForm" method="POST" action="{{ route('users.createComment') }}">
                        @csrf
                        @include('displayError')
                        <div class="user-info">
                            @if(Auth::user()->userPhoto)
                                <img src="{{ Storage::url(Auth::user()->userPhoto) }}" class="user-profile-photo" alt="Profile Picture">
                            @else
                                <img src="../../imgs/user-img.png" class="user-profile-photo" alt="Profile Picture">
                            @endif
                            <div class="user-details">
                                <h4>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</h4>
                                <label>@<span>{{ Auth::user()->username }}</span></label>
                            </div>
                        </div>
                
                        <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                
                        <input type="text" name="comment" placeholder="Write a comment..." required>
                
                        <button type="submit">Send</button>
                    </form>
                </div>                
                
            </div>
        </div>
    </div>


  


    <script src="../js/settings.js"></script>
    <script src="../js/home_js.js"></script>
    <script src="../js/profile.js"></script>

    <script>
        const postsData = {
            @foreach($posts as $post)
            "{{ $post->post_id }}": {
                "userPhoto": "{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : '../../imgs/user-img.png' }}",
                "userName": "{{ $user->firstName }} {{ $user->lastName }}",
                "username": "{{ $user->username }}",
                "concern": "{{ $post->concern }}",
                "concernPhoto": "{{ $post->concernPhoto ? Storage::url($post->concernPhoto) : '' }}",
                "comments": [
                    @foreach($post->comments as $comment)
                    {
                        "user": "{{ $comment->user ? $comment->user->firstName . ' ' . $comment->user->lastName : 'Unknown User' }}",
                        "comment": "{{ $comment->comment }}"
                    },
                    @endforeach
                ]
            },
            @endforeach
        };

                
        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('commentModal');
            const modalUserPhoto = document.getElementById('modalUserPhoto');
            const modalUserName = document.getElementById('modalUserName');
            const modalUserUsername = document.getElementById('modalUserUsername');
            const modalPostText = document.getElementById('modalPostText');
            const modalPostPhoto = document.getElementById('modalPostPhoto');
            const commentArea = document.querySelector('.comment-area'); // Reference to the comment area
            const commentForm = document.getElementById('commentForm'); // Get the comment form
            const hiddenPostIdInput = commentForm.querySelector('input[name="post_id"]'); // Get the hidden input for post_id

            document.querySelectorAll('.btn-comment').forEach(function (button) {
                button.addEventListener('click', function () {
                    // Get the post ID
                    const postId = this.getAttribute('data-post-id');

                    const postData = postsData[postId];

                    if (postData) {
                        // Set post data
                        modalUserPhoto.src = postData.userPhoto;
                        modalUserName.innerText = postData.userName;
                        modalUserUsername.innerText = postData.username;
                        modalPostText.innerText = postData.concern;

                        if (postData.concernPhoto) {
                            modalPostPhoto.src = postData.concernPhoto;
                            modalPostPhoto.style.display = 'block';
                        } else {
                            modalPostPhoto.style.display = 'none';
                        }

                        // Clear previous comments
                        commentArea.innerHTML = '';

                        // Populate comments
                        postData.comments.forEach(function (comment) {
                            const commentElement = document.createElement('div');
                            commentElement.classList.add('comment');
                            commentElement.innerHTML = `<p>${comment.user}: ${comment.comment}</p>`;
                            commentArea.appendChild(commentElement);
                        });

                        // Set the correct post ID in the hidden input field of the comment form
                        hiddenPostIdInput.value = postId;

                        // Show the modal
                        modal.classList.add('show');
                    }
                });
            });

            // Hide the modal when clicking outside of it
            window.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.remove('show');
                }
            });
        });


    </script>
    
</body>
</html>
