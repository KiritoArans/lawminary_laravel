
@foreach($posts as $post)
<div class="comment-modal" id="commentModal-{{ $post->post_id }}" style="display:none;">
    <div class="clicked-post-content">
        <div class="clicked-post-header">
            <div class="user-info">
                <img src="{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png') }}" class="user-profile-photo" alt="Profile Picture">
                <div class="clicked-post-info">
                    <h2 id="modalUserName">
                        <a href="{{ Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id]) }}">
                            {{ $post->user->firstName }} {{ $post->user->lastName }}
                        </a>
                    </h2>
                    <label>@<span id="modalUserUsername">{{ $user->username }}</span></label>
                    <p> {{ $post->created_at->format('M d, Y H:i A') }}</p>
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
                        <img src="{{ $comment->user->userPhoto ? Storage::url($comment->user->userPhoto) : '../imgs/user-img.png' }}" alt="User Profile Picture" class="user-profile-photo">
                    </div>
                    <div class="user-comment-content">
                        <span>
                            <a href="{{ Auth::check() && Auth::user()->user_id == $comment->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $comment->user->user_id]) }}">
                                {{ $comment->user ? $comment->user->firstName . ' ' . $comment->user->lastName : 'Unknown User' }}
                            </a> 
                        </span>                                    
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
                            <img src="{{ $reply->user->userPhoto ? Storage::url($reply->user->userPhoto) : '../imgs/user-img.png' }}" alt="User Profile Picture" class="user-profile-photo">
                        </div>
                        <div class="user-reply-content">
                            <span>
                                <a href="{{ Auth::check() && Auth::user()->user_id == $reply->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $reply->user->user_id]) }}">
                                    {{ $reply->user ? $reply->user->firstName . ' ' . $reply->user->lastName : 'Unknown User' }}
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

            @endforeach
            </div>
            <hr>
            <div class="comment-field">
                @include('inclusions/response')
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