<div class="posts">
    <div class="post-content">
        <div class="post-header">
            <div class="user-info">
                <img
                    src="{{ $post->user->userPhoto ? Storage::url($post->user->userPhoto) : '../imgs/user-img.png' }}"
                    alt="Profile Picture"
                    class="user-profile-photo"
                />
                <div class="post-info">
                    <h2>
                        <a
                            href="{{ Auth::check() && Auth::user()->user_id == $post->user->user_id ? route('profile') : route('visit-profile', ['user_id' => $post->user->user_id]) }}"
                        >
                            {{ $post->user ? ($post->user->accountType === 'Lawyer' ? 'Atty. ' : '') . $post->user->firstName . ' ' . $post->user->lastName : 'Unknown User' }}
                        </a>
                    </h2>
                    <label>@<span>{{ $post->user->username }}</span></label>
                    <p for="">
                        Posted:
                        {{ $post->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>

            <div class="post-options">
                <div class="options">
                    @if (Auth::check() && Auth::user()->user_id == $post->user->user_id)
                        <button onclick="confirmDelete('{{ $post->post_id }}')" class="btn-delete">
                            Delete
                        </button>

                        <form
                            id="delete-form-{{ $post->post_id }}"
                            action="{{ route('post.delete', $post->post_id) }}"
                            method="POST"
                            style="display: none"
                        >
                            @csrf
                            @method('DELETE')
                        </form>
                    @else
                        <a id="reportLink" data-post-id="{{ $post->post_id }}">
                            Report
                        </a>
                    @endif
                </div>
                <i class="fas fa-ellipsis-v"></i>
            </div>
        </div>

        <hr />

        <div class="post-text">
            <p>{{ $post->concern }}</p>
            <div class="post-category-privacy">
                <a href="home-search?query={{$post->concernCategory}}">{{ $post->concernCategory }}</a>
                <span>{{ $post->privacy}}</span>
            </div>
            @if ($post->concernPhoto)
                <img
                    src="{{ Storage::url($post->concernPhoto) }}"
                    alt="Concern Photo"
                    onclick="openConPhoto('{{ $post->post_id }}')"
                />
            @endif
        </div>

        <hr />

        <div class="actions">
            @php
                $hasLiked = \App\Models\Like::where('user_id', Auth::user()->user_id)
                    ->where('post_id', $post->post_id)
                    ->exists();

                $hasBookmarked = \App\Models\Bookmark::where('user_id', Auth::user()->user_id)
                    ->where('post_id', $post->post_id)
                    ->exists();
            @endphp

            <form
                class="like-form"
                data-post-id="{{ $post->post_id }}"
                action="{{ route('post.like') }}"
                method="POST"
            >
                @csrf
                <input
                    type="hidden"
                    name="post_id"
                    value="{{ $post->post_id }}"
                />
                <button
                    type="submit"
                    class="btn-hit {{ $hasLiked ? 'btn-hitted' : '' }}"
                >
                    <i class="fa-solid fa-gavel"></i>
                    <span>Hit</span>
                    <span id="likes-count-{{ $post->post_id }}">
                        ({{ $post->likes_count }})
                    </span>
                </button>
            </form>

            <button
                class="btn-comment"
                data-post-id="{{ $post->post_id }}"
            >
                <i class="fas fa-comment"></i>
                <span>Comment</span>
                @if ($post->comments_count > 0)
                    <span>({{ $post->comments_count }})</span>
                @endif
            </button>

            <form
                class="bookmark-form"
                data-post-id="{{ $post->post_id }}"
                action="{{ route('post.bookmark') }}"
                method="POST"
            >
                @csrf
                <input
                    type="hidden"
                    name="post_id"
                    value="{{ $post->post_id }}"
                />
                <button
                    type="submit"
                    class="btn-bookmark {{ $hasBookmarked ? 'btn-bookmarked' : '' }}"
                >
                    <i class="fas fa-bookmark"></i>
                    <span>Bookmark</span>
                    <span id="bookmark-count-{{ $post->post_id }}">
                        ({{ $post->bookmarks_count }})
                    </span>
                </button>
            </form>
        </div>
        @if (Auth::check() && Auth::user()->user_id == $post->user->user_id && $post->privacy != 'Public')
            <div class="publish-public">
                <form action="">
                    <button type="button" class="publishToPublicBtn" data-post-id="{{ $post->post_id }}">
                        <span>Publish to Public</span>
                        <i class="fa-solid fa-check"></i>
                    </button>
                </form>
            </div>
            
        @endif
    </div>
</div>
@include('inclusions/showConcernPhoto')