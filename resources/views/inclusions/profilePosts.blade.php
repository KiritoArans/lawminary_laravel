<div class="profile-posts">
    @foreach($posts as $post)
        <div class="posts">
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
                            <h2>
                                @if (Auth::check() && Auth::user()->user_id == $post->user->user_id)
                                    <a href="{{ route('profile') }}">
                                        {{ $post->user->firstName }} {{ $post->user->lastName }}
                                    </a>
                                @else
                                <a href="{{ route('visit-profile', ['user_id' => $post->user->user_id]) }}">
                                    {{ $post->user->firstName }} {{ $post->user->lastName }}
                                </a>
                                @endif
                            </h2>                            <label>@<span>{{ $user->username }}</span></label>
                            <p for="">Posted: {{ $post->created_at->diffForHumans() }}</p>
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
            
            {{-- @include('inclusions/openComments') --}}
            
        </div>
    @endforeach
</div>