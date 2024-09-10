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
                                <h2>{{ $user->firstName }} {{ $user->lastName }}</h2>
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
                                    <span>{{ $user->following_count }}</span>
                                </div>
                                <div class="follower-count">
                                    <span>Followers:</span>
                                    <span>{{ $user->followers_count }}</span>
                                </div>
                                @if(Auth::id() === $user->id)
                                    <a href="{{ route('settings.account') }}" class="edit-profile-button">Edit Profile</a>
                                @else
                                    <a href="" class="edit-profile-button">Follow</a>
                                @endif
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

                    <div class="posts">
                        @foreach($posts as $post)
                            <div class="post-content">
                                <div class="post-header">
                                    <div class="user-info">
                                        @if($post->user)
                                            <img src="{{ $post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo">
                                            <div class="post-info">
                                                <h2>
                                                @if (Auth::check() && Auth::user()->user_id == $post->user->user_id)
                                                    <a href="{{ route('profile') }}">
                                                        {{ $post->user->firstName }} {{ $post->user->lastName }}
                                                    </a>
                                                @else
                                                <a href="{{ route('visit-profile', ['user_id' => $post->user->user_id]) }}">
                                                    {{ $post->user->firstName }} {{ $post->user->lastName }}
                                                </a>
                                                @endif
                                                </h2>
                                                <label>@<span>{{ $post->user->username }}</span></label>
                                                <p for="">Posted: {{ $post->created_at->diffForHumans() }}</p>
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
                                    <button class="btn-hit" data-post-id="{{ $post->post_id }}" data-user-id="{{ Auth::id() }}">
                                        <i class="fa-solid fa-gavel"></i> Hit
                                    </button>
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
                                                    <label>@<span id="modalUserUsername">{{ $post->user->username }}</span></label>
                                                    <p class="comment-time"> {{ $post->created_at->format('M d, Y H:i A') }}</p>
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
                                                    <div class="user-comment-content">
                                                        <span>{{ $comment->user ? $comment->user->firstName . ' ' . $comment->user->lastName : 'Unknown User' }}</span>
                                                        <p>{{ $comment->comment }}</p>
                                                        <div class="date-reply">
                                                            <p class="comment-time">{{ $comment->created_at->diffForHumans() }}</p>
                                                            <a href="javascript:void(0);" class="reply-btn" data-comment-id="{{ $comment->id }}">Reply</a>
                                                        </div>
                                                        
                                                        <div class="reply-field" id="reply-field-{{ $comment->id }}">
                                                            <form action="{{ route('users.createReply') }}" method="POST">
                                                                @csrf
                                                                <textarea name="reply" id="reply-textarea-{{ $comment->id }}" placeholder="Replying to {{ $comment->user ? $comment->user->firstName : 'Unknown User' }}"></textarea>
                                                                <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                                                                <input type="hidden" name="comment_id" value="{{ $comment->comment_id }}">
                                                                <button type="submit">Send</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @foreach($comment->reply as $reply)
    
                                                    <div class="user-reply">
                                                        <div>
                                                            @if($reply->user && $reply->user->userPhoto)
                                                                <img src="{{ Storage::url($reply->user->userPhoto) }}" alt="User Profile Picture" class="user-profile-photo">
                                                            @else
                                                                <img src="../../imgs/user-img.png" alt="Default User Image" class="user-profile-photo">
                                                            @endif
                                                        </div>
                                                        <div class="user-reply-content">
                                                            <span>{{ $reply->user ? $reply->user->firstName . ' ' . $reply->user->lastName : 'Unknown User' }}</span>
                                                            <label>replied to 
                                                                <span>{{ $comment->user ? $comment->user->firstName: 'Unknown User' }}</span>'s comment.
                                                            </label>
                                                            <p>{{ $reply->reply }}</p>
                                                            <div class="date-reply">
                                                                <p class="comment-time">{{ $reply->created_at->diffForHumans() }}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div class="comment-field" id="comment-field">
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

                    
                    {{-- @include('inclusions/profilePosts') --}}

                    {{-- @include('inclusions/createPostModal') --}}
                    
                    {{-- @include('inclusions/profileCommsReps') --}}

                </div>
            </content>
        </main>
    </div>

    <script src="/js/postandcomment.js"></script>
    <script src="/js/settings.js"></script>
    <script src="/js/profile.js"></script>
    <script src="/js/logout.js"></script>
</body>
</html>
