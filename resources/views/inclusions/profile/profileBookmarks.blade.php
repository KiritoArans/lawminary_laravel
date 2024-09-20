<div class="profile-bookmarked">
    @if($bookmarks->isEmpty())
        <div class="empty">No bookmarks yet.</div>
    @endif
    @foreach($bookmarks as $post)
        <div class="posts">
            <div class="post-content">
                <div class="post-header">
                    <div class="user-info">
                        <img src="{{ $post->userPhoto ? Storage::url($post->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo">
                        <div class="post-info">
                            <h2>
                                <a href="{{ Auth::check() && Auth::user()->user_id == $post->postedBy ? route('profile') : route('visit-profile', ['user_id' => $post->postedBy]) }}">
                                    {{ $post->accountType === 'Attorney' ? 'Atty. ' : '' }}{{ $post->firstName }} {{ $post->lastName }}
                                </a>
                            </h2>                            
                            <label>@<span>{{ $post->username ?? 'username' }}</span></label>
                            <p>Posted: {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="post-options">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
                <hr>
                <div class="post-text">
                    <p>{{ $post->concern ?? 'No content available' }}</p> <!-- Post content -->
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
                    
                    <button class="btn-comment" data-post-id="{{ $post->post_id }}">
                        <i class="fas fa-comment"></i> Comment
                    </button>

                    <form action="{{ route('post.bookmark') }}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{ $post->post_id }}">
                    
                        <button type="submit" class="btn-bookmark {{ $hasBookmarked ? 'btn-bookmarked' : "" }}">
                            <i class="fas fa-bookmark"></i> Bookmark
                        </button>
                    </form>

                </div>
            </div>
        </div>
    @endforeach
</div>