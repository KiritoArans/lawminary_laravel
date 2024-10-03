<div class="profile-posts">
    @if (Auth::user()->user_id == $user->user_id)
        <div class="pending-btn">
            <button class="view-pendings">View Pending Posts</button>
        </div>
    @endif
    
    @if($posts->isEmpty())
        <div class="empty">No posts yet.</div>
    @endif
    @foreach($posts as $post)
        <div class="posts">
            @if($posts->isEmpty())
                <p>No posts yet.</p>
            @endif
            <div class="post-content">
                <div class="post-header">
                    <div class="user-info">
                        <img src="{{ $post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Picture" class="user-profile-photo">
                        <div class="post-info">
                            <h2>
                                <a href="{{ Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id]) }}">
                                    {{ $post->user ? ($post->user->accountType === 'Lawyer' ? 'Atty. ' : '') . $post->user->firstName . ' ' . $post->user->lastName : 'Unknown User' }}
                                </a>                                
                            </h2>                           
                            <label>@<span>{{ $user->username }}</span></label>
                            <p for="">Posted: {{ $post->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="post-options">
                        <div class="options">
                            <button onclick="confirmDelete('{{ $post->post_id }}')" class="btn-delete">
                                Delete
                            </button>
                            <form id="delete-form-{{ $post->post_id }}" action="{{ route('post.delete', $post->post_id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            {{-- <a href="">Report</a> --}}
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

                    <button class="btn-comment" data-post-id="{{ $post->post_id }}">
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
            </div>
        </div>
    @endforeach
</div>