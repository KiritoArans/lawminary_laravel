<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lawminary | Viewing Post</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
    <link rel="stylesheet" href="{{ asset('css/home_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/responsive/navres.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/otherstyles/posts_style.css') }}" />
    @include('inclusions/libraryLinks')
    @include('inclusions/broadcastJS')
</head>
<body>
    <div class="container">
        @include('inclusions/userNav')
        <main>
            <header>
                <div class="header-top">
                    <i class="fa-solid fa-bars"></i>
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
            <div class="header-buttons-search">
                <div class="header-buttons">
                    <button id="postsTab" class="posts-tab">
                        <span>Posts</span>
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </button>
                    <button id="forumsTab" class="forums-tab">
                        <span>Forums</span>
                        <i class="fa-solid fa-users"></i>
                    </button>
                    <button id="articlesTab" class="articles-tab">
                        <span>Articles</span>
                        <i class="fa-solid fa-scale-balanced"></i>
                    </button>
                    <button id="leaderboardsTab" class="leaderboards-tab">
                        <span>Top Lawyers</span>
                        <i class="fa-solid fa-chart-simple"></i>
                    </button>
                </div>

                <div class="search-bar">
                    <form id="searchForm" action="/home-search" method="GET">
                        <input type="text" name="query" id="searchQuery" placeholder="Search a user or post" required />
                        <i class="fas fa-search search-icon" onclick="document.getElementById('searchForm').submit();"></i>
                        <button type="submit">Search</button>
                    </form>
                </div>

            </div>
            <content>
                <div class="posts">
                        <div class="post-content">
                            <div class="post-header">
                                <div class="user-info">
                                    <img src="{{ $post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo" />
                                    <div class="post-info">
                                        <div class="name-follow">
                                            <h2>
                                                <a href="{{ Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id]) }}">
                                                    {{ $post->user ? ($post->user->accountType === 'Lawyer' ? 'Atty. ' : '') . $post->user->firstName . ' ' . $post->user->lastName : 'Unknown User' }}
                                                </a>
                                            </h2>
                                            @if (Auth::user()->user_id != $post->user->user_id)
                                            <label>|</label>
                                            @php
                                                $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)->where('following', $post->postedBy)->exists();
                                            @endphp
                
                                            <form class="follow-form" action="{{ route('followUser') }}" method="POST" style="display: inline">
                                                @csrf
                                                <input type="hidden" name="following" value="{{ $post->user->user_id }}" />
                                                <button type="submit" class="follow-btn {{ $haveFollowed ? 'following' : '' }}">{{ $haveFollowed ? 'Unfollow' : 'Follow' }}</button>
                                            </form>
                
                                            @endif
                                        </div>
                                        <label>@<span>{{ $post->user->username ?? 'unknownuser' }}</span></label>
                                        <p>Posted: {{ $post->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                
                                <div class="post-options">
                                    <div class="options">
                                        @if (Auth::check() && Auth::user()->user_id == $post->user->user_id)
                                            <button onclick="confirmDelete('{{ $post->post_id }}')" class="btn-delete">
                                                Delete
                                            </button>
                                            
                                            <form id="delete-form-{{ $post->post_id }}" action="{{ route('post.delete', $post->post_id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @else
                                            <a id="reportLink" data-post-id="{{ $post->post_id }}">Report</a>
                                        @endif
                                    </div>
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>                            
                
                            </div>
                            <hr />
                            <div class="post-text">
                                <p>{{ $post->concern }}</p>
                                @if ($post->concernPhoto)
                                <img src="{{ Storage::url($post->concernPhoto) }}" alt="Post Image" style="max-width: 100%; height: auto;" />
                                @endif
                            </div>
                            <hr />
                            <div class="actions">
                                @php
                                    $hasLiked = \App\Models\Like::where('user_id', Auth::user()->user_id)->where('post_id', $post->post_id)->exists();
                                    $hasBookmarked = \App\Models\Bookmark::where('user_id', Auth::user()->user_id)->where('post_id', $post->post_id)->exists();
                                @endphp
                
                                <form class="like-form" data-post-id="{{ $post->post_id }}" action="{{ route('post.like') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->post_id }}" />
                                    <button type="submit" class="btn-hit {{ $hasLiked ? 'btn-hitted' : '' }}">
                                        <i class="fa-solid fa-gavel"></i>Hit
                                        <span id="likes-count-{{ $post->post_id }}">({{ $post->likes_count }})</span>
                                    </button>
                                </form>
                
                                <button class="btn-comments">
                                    <i class="fas fa-comment"></i>Comment
                                    @if($post->comments_count > 0)
                                        <span>({{ $post->comments_count }})</span>
                                    @endif
                                </button>
                
                                <form class="bookmark-form" data-post-id="{{ $post->post_id }}" action="{{ route('post.bookmark') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->post_id }}" />
                                    <button type="submit" class="btn-bookmark {{ $hasBookmarked ? 'btn-bookmarked' : '' }}">
                                        <i class="fas fa-bookmark"></i> Bookmark
                                        <span id="bookmark-count-{{ $post->post_id }}">({{ $post->bookmarks_count }})</span>
                                    </button>
                                </form>
                                
                            </div>

                        {{-- <script>
                            window.postId = '{{ $post->post_id }}';
                        </script> --}}
                        
                        <hr>

                        <div class="comment-section" id="comments-section-{{ $post->post_id }}">
                            <div class="comment-area" id="comment-area-{{ $post->post_id }}">
                            @foreach($post->comments as $comment)
            
                                <div class="user-comment">
                                    <div>
                                        <img src="{{ $comment->user->userPhoto ? Storage::url($comment->user->userPhoto) : '../imgs/user-img.png' }}" alt="User Profile Picture" class="user-profile-photo">
                                    </div>
                                    <div class="user-comment-content">
                                        <span>
                                            <a href="{{ Auth::check() && Auth::user()->user_id == $comment->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $comment->user->user_id]) }}">
                                                {{ $comment->user ? ($comment->user->accountType === 'Lawyer' ? 'Atty. ' : '') . $comment->user->firstName . ' ' . $comment->user->lastName : 'Unknown User' }}
                                            </a>
                                            @if($comment->user->accountType === 'Lawyer' && $comment->user->user_id !== Auth::user()->user_id)
                                              <i class="fa-regular fa-star rate-btn" 
                                                  data-rating-comment-comment_id="{{ $comment->comment_id }}" 
                                                  data-rating-comment-user_id="{{ $comment->user->user_id }}">
                                              </i>
                                            @endif
                                        </span>                                     
                                        <p>{{ $comment->comment }}</p>
                                        <div class="date-reply">
                                            <p class="comment-time">{{ $comment->created_at->diffForHumans() }}</p>
                                            <a href="javascript:void(0);" class="reply-btn" data-comment-id="{{ $comment->comment_id }}">Reply</a>
                                        </div>
                                        <div class="reply-field" id="reply-field-{{ $comment->comment_id }}">
                                            @php
                                                $attorneyComments = $post->comments->filter(function ($comment) {
                                                    return $comment->user->accountType === 'Lawyer';
                                                });
                                        
                                                $isSameLawyer = $attorneyComments->contains(function ($comment) {
                                                    return $comment->user->user_id === Auth::user()->user_id;
                                                });
                                        
                                                $isLawyer = Auth::user()->accountType === 'Lawyer';
                                        
                                                $isPostOwner = $post->user->user_id === Auth::user()->user_id;
                                            @endphp
                                        
                                            @if ($attorneyComments->isNotEmpty() && $isLawyer && !$isSameLawyer && !$isPostOwner)
                                                <label class="comment-warning">Comments and Replies are not accomodated by this post anymore.</label>
                                            @else
                                            <form id="reply-form-{{ $comment->comment_id }}" action="{{ route('users.createReply') }}" method="POST">
            
                                                @csrf
                                                <textarea name="reply" id="reply-textarea-{{ $comment->comment_id }}" placeholder="Replying to {{ $comment->user ? $comment->user->firstName : 'Unknown User' }}"></textarea>
                                                <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                                                <input type="hidden" name="comment_id" value="{{ $comment->comment_id }}">
                                                <button type="submit">Send</button>
                                            </form>
                                            
                                            @endif
                                        </div>      
                                    </div>
                                </div>
                                @if($comment->reply->isNotEmpty())
                                    <div class="view-reply">
                                        <a href="javascript:void(0);" onclick="toggleReplies('{{ $comment->comment_id }}', this)">View Replies</a>
                                    </div>
                                @endif
                                <div id="replies-{{ $comment->comment_id }}" style="display: none;">
            
                                    @foreach($comment->reply as $reply)
                                        <div class="user-reply">
                                            <div>
                                                <img src="{{ $reply->user->userPhoto ? Storage::url($reply->user->userPhoto) : '../imgs/user-img.png' }}" alt="User Profile Picture" class="user-profile-photo">
                                            </div>
                                            <div class="user-reply-content">
                                                <span>
                                                    <a href="{{ Auth::check() && Auth::user()->user_id == $reply->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $reply->user->user_id]) }}">
                                                        {{ $reply->user ? ($reply->user->accountType === 'Lawyer' ? 'Atty. ' : '') . $reply->user->firstName . ' ' . $reply->user->lastName : 'Unknown User' }}
                                                    </a>
                                                </span>                                                        
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
                                </div>
                            @endforeach
                            </div>
                            <hr>
                            <div class="comment-field" id="comment-field-{{ $post->post_id }}">
                                @php
                                    $attorneyComments = $post->comments->filter(function ($comment) {
                                        return $comment->user->accountType === 'Lawyer';
                                    });
                            
                                    $isSameLawyer = $attorneyComments->contains(function ($comment) {
                                        return $comment->user->user_id === Auth::user()->user_id;
                                    });
                            
                                    $isLawyer = Auth::user()->accountType === 'Lawyer';
                            
                                    $isPostOwner = $post->user->user_id === Auth::user()->user_id;
                                @endphp
                            
                                @if ($attorneyComments->isNotEmpty() && $isLawyer && !$isSameLawyer && !$isPostOwner)
                                    <label class="comment-warning">An attorney has already commented on this post.</label>
                                @else
                                    <form id="commentForm-{{ $post->post_id }}" method="POST" action="{{ route('users.createComment') }}">
                                        @csrf
                                        <img src="{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png') }}" class="user-profile-photo" alt="Profile Picture">
                                        <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                                        <textarea name="comment" placeholder="Write a comment..." required></textarea>
                                        <button type="submit">Send</button>
                                    </form>
                                @endif
                            </div>                                    
                        </div>

                    </div>
                </div>

                @include('inclusions/rateCommentModal')

                @include('inclusions/reportPostModal')

            </content>
        </main>
    </div>

    <script src="js/postandcomment.js"></script>
    <script src="js/likePost.js"></script>
    <script src="js/bookmarkPost.js"></script>
    <script src="js/commentPost.js"></script>
    <script src="js/replyPost.js"></script>
    <script src="js/rateComment.js"></script>

    <script src="js/reportPost.js"></script>

    <script src="js/followUser.js"></script>
    
    <script src="js/showNotification.js"></script>

    <script src="js/showUserNav.js"></script>
    
    <script src="js/homelocator.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/logout.js"></script>
    
</body>
</html>
