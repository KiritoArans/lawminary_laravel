@foreach($allPosts as $post)
    <div class="comment-modal" id="commentModal-{{ $post->post_id }}" style="display:none;">
        <div class="clicked-post-content">
            <div class="clicked-post-header">
                <div class="user-info">
                    <img src="{{ $post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo">
                    <div class="clicked-post-info">
                        <h2 id="modalUserName">
                            <a href="{{ Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id]) }}">
                                {{ $post->user ? ($post->user->accountType === 'Lawyer' ? 'Atty. ' : '') . $post->user->firstName . ' ' . $post->user->lastName : 'Unknown User' }}
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
                
                <form class="like-form" data-post-id="{{ $post->post_id }}" action="{{ route('post.like') }}" method="POST">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->post_id }}" />
                    <button type="submit" class="btn-hit {{ $hasLiked ? 'btn-hitted' : '' }}">
                        <i class="fa-solid fa-gavel"></i>Hit
                        <span id="likes-count-{{ $post->post_id }}">({{ $post->likes_count }})</span>
                    </button>
                </form>
                
                <button><i class="fas fa-comment"></i> Comment
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
                                @if($comment->user->accountType === 'Lawyer')
                                    <i class="fa-regular fa-star rate-btn" 
                                        data-rating-comment-comment_id="{{ $comment->comment_id }}" 
                                        data-rating-comment-user_id="{{ $comment->user->user_id }}">
                                    </i>
                                @endif
                            </span>                                     
                            <p>{{ $comment->comment }}</p>
                            <div class="date-reply">
                                <p class="comment-time">{{ $comment->created_at->diffForHumans() }}</p>
                                <a href="javascript:void(0);" class="reply-btn" data-comment-id="{{ $comment->id }}">Reply</a>
                            </div>
                            <div class="reply-field" id="reply-field-{{ $comment->id }}">
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
                    @if($comment->reply->isNotEmpty())
                        <div class="view-reply">
                            <a href="javascript:void(0);" onclick="toggleReplies({{ $comment->id }}, this)">View Replies</a>
                        </div>
                    @endif
                    <div id="replies-{{ $comment->id }}" style="display: none;">
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
                <div class="comment-field" id="comment-field comment-field-{{ $post->post_id }}">
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
                        <form id="commentForm commentForm-{{ $post->post_id }}" method="POST" action="{{ route('users.createComment') }}">
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