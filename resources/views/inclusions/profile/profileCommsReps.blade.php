@foreach($posts as $post)
    <div class="profile-comments">
        @foreach($comments as $comment)
        <div class="comments">
            <div class="comment-content">
                <div class="comment-header">
                    <div class="user-info">
                        <img src="{{ $post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo">
                        <div class="comment-info">
                            <h2>{{ $user->firstName }} {{ $user->lastName }}</h2>
                            <label>@<span>{{ $user->username }}</span></label>
                        </div>
                    </div>
                        {{-- <div class="comment-options">
                            <i class="fas fa-ellipsis-v"></i>
                        </div> --}}
                </div>
                <hr>
                <div class="comment-text">
                    <p>{{ $comment->comment }}</p>
                    <div class="date-time">
                        <p for="">{{ $comment->created_at->diffForHumans() }}</p>
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
    </div>
@endforeach