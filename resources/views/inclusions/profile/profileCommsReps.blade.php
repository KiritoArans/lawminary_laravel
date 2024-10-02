<div class="profile-comments">
    @if($comments->isEmpty())
        <div class="empty">No comments yet.</div>
    @else
        @foreach($comments as $comment)
                <div class="comments">
                    <div class="comment-content">
                        <div class="comment-header">
                            <div class="user-info">
                                <img src="{{ $comment->user->userPhoto ? Storage::url($comment->user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo">
                                <div class="comment-info">
                                    <h2>{{ $comment->user->accountType === 'Lawyer' ? 'Atty. ' : '' }}{{ $comment->user->firstName }} {{ $comment->user->lastName }}</h2>
                                    <label>@<span>{{ $comment->user->username }}</span></label>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="comment-text">
                            <p>{{ $comment->comment }}</p>
                            <div class="date-time">
                                <p>{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <hr>
                        <div class="actions">
                            <button class="btn-comment" data-post-id="{{ $comment->post_id }}">
                                View Post
                            </button>
                        </div>            
                    </div>
                </div>
        @endforeach
    @endif
</div>