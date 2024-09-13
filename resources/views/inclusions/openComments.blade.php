
@foreach($allPosts as $post)
    <div class="comment-modal" id="commentModal-{{ $post->post_id }}" style="display:none;">
        <div class="clicked-post-content">
            <div class="clicked-post-header">
                <div class="user-info">
                    <img src="{{ $post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo">
                    <div class="clicked-post-info">
                        <h2 id="modalUserName">
                            <a href="{{ Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id]) }}">
                                {{ $post->user ? ($post->user->accountType === 'Attorney' ? 'Atty. ' : '') . $post->user->firstName . ' ' . $post->user->lastName : 'Unknown User' }}
                            </a>
                        </h2>  
                        <label>@<span id="modalUserUsername">{{ $post->user->username }}</span></label>
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
                @php
                    $hasLiked = \App\Models\Like::where('user_id', Auth::user()->user_id)
                                ->where('post_id', $post->post_id)
                                ->exists();

                    $hasBookmarked = \App\Models\Bookmark::where('user_id', Auth::user()->user_id)
                                ->where('post_id', $post->post_id)
                                ->exists();
                @endphp
                <form action="{{ route('post.like') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                
                    <button type="submit" class="btn-hit {{ $hasLiked ? 'btn-hitted' : "" }}">
                        <i class="fa-solid fa-gavel"></i> Hit
                    </button>
                </form>
                
                <button><i class="fas fa-comment"></i> Comment</button>

                <form action="{{ route('post.bookmark') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                
                    <button type="submit" class="btn-bookmark {{ $hasBookmarked ? 'btn-bookmarked' : "" }}">
                        <i class="fas fa-bookmark"></i> Bookmark
                    </button>
                </form>
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
                                    {{ $comment->user ? ($comment->user->accountType === 'Attorney' ? 'Atty. ' : '') . $comment->user->firstName . ' ' . $comment->user->lastName : 'Unknown User' }}
                                </a>
                            </span>                                     
                            <p>{{ $comment->comment }}</p>
                            <div class="date-reply">
                                <p class="comment-time">{{ $comment->created_at->diffForHumans() }}</p>
                                <a href="javascript:void(0);" class="reply-btn" data-comment-id="{{ $comment->id }}">Reply</a>
                            </div>
                            <div class="reply-field" id="reply-field-{{ $comment->id }}">
                                @php
                                    $attorneyComments = $post->comments->filter(function ($comment) {
                                        return $comment->user->accountType === 'Attorney';
                                    });
                            
                                    $isSameAttorney = $attorneyComments->contains(function ($comment) {
                                        return $comment->user->user_id === Auth::user()->user_id;
                                    });
                            
                                    $isAttorney = Auth::user()->accountType === 'Attorney';
                            
                                    $isPostOwner = $post->user->user_id === Auth::user()->user_id;
                                @endphp
                            
                                @if ($attorneyComments->isNotEmpty() && $isAttorney && !$isSameAttorney && !$isPostOwner)
                                    <label class="comment-warning">Comments and Replies are not accomodated by this post anymore.</label>
                                @else
                                    <form action="{{ route('users.createReply') }}" method="POST">
                                        @csrf
                                        <textarea name="reply" id="reply-textarea-{{ $comment->id }}" placeholder="Replying to {{ $comment->user ? $comment->user->firstName : 'Unknown User' }}"></textarea>
                                        <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                                        <input type="hidden" name="comment_id" value="{{ $comment->comment_id }}">
                                        <button type="submit">Send</button>
                                    </form>
                                @endif
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
                                        {{ $reply->user ? ($reply->user->accountType === 'Attorney' ? 'Atty. ' : '') . $reply->user->firstName . ' ' . $reply->user->lastName : 'Unknown User' }}
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
                <div class="comment-field" id="comment-field">
                    @php
                        $attorneyComments = $post->comments->filter(function ($comment) {
                            return $comment->user->accountType === 'Attorney';
                        });
                
                        $isSameAttorney = $attorneyComments->contains(function ($comment) {
                            return $comment->user->user_id === Auth::user()->user_id;
                        });
                
                        $isAttorney = Auth::user()->accountType === 'Attorney';
                
                        $isPostOwner = $post->user->user_id === Auth::user()->user_id;
                    @endphp
                
                    @if ($attorneyComments->isNotEmpty() && $isAttorney && !$isSameAttorney && !$isPostOwner)
                        <label class="comment-warning">An attorney has already commented on this post.</label>
                    @else
                        <form id="commentForm" method="POST" action="{{ route('users.createComment') }}">
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
@endforeach