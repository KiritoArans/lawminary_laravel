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
                        <img src="{{ Storage::url($post->concernPhoto) }}" alt="Concern Photo">
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
                            @if(Auth::user()->userPhoto)
                            <img src="{{ Storage::url(Auth::user()->userPhoto) }}" class="user-profile-photo" alt="Profile Picture">
                            @else
                                <img src="../../imgs/user-img.png" class="user-profile-photo" alt="Profile Picture">
                            @endif
                            <div class="clicked-post-info">
                                <h2 id="modalUserName">{{ $user->firstName }} {{ $user->lastName }}</h2>
                                <p>@<span id="modalUserUsername">{{ $user->username }}</span></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="clicked-post-text">
                        <p id="modalPostText">{{ $post->concern }}</p>
                        @if ($post->concernPhoto)
                            <img id="modalPostPhoto" src="{{ Storage::url($post->concernPhoto) }}" alt="Concern Photo">
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
            
                        @if(session('post_id') == $post->post_id && session('new_comment'))
                        <div class="user-comment">
                            <div>
                                <img src="{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : '../../imgs/user-img.png' }}" alt="User Profile Picture" class="user-profile-photo">
                            </div>
                            <div>
                                <span>{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                                <p>{{ session('new_comment')->comment }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
            
                        <hr>
            
                        <div class="comment-field">
                            <form method="POST" action="{{ route('users.createComment') }}">
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
</div>