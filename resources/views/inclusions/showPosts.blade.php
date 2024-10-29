<div class="posts">
    @if($posts->isEmpty())
    <div class="empty">No posts available.</div>
    @endif

    @foreach ($posts as $post)
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
                <div>
                    <a href="home-search?query={{$post->concernCategory}}">{{ $post->concernCategory }}</a>
                </div>
                @if ($post->concernPhoto)
                    <img src="{{ Storage::url($post->concernPhoto) }}" 
                        alt="Concern Photo" 
                        onclick="openConPhoto('{{ $post->post_id }}')"
                        style="max-width: 100%; height: auto;" />
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

        <script>
            window.postId = '{{ $post->post_id }}';
        </script>

        @include('inclusions/showConcernPhoto')

    @endforeach
</div>