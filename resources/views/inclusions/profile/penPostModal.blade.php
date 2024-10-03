<div id="pendingModal" class="pendingModal" style="display: none;">
    <div class="pendingModal-content">
        <span class="pen-post-close">&times;</span>
    
        <div class="pendingModal-nav">
            <span id="pending-posts-tab" class="active">Pending Posts ({{ $pendingPosts->count() }})</span>
            <span id="disregarded-posts-tab">Disregarded Posts ({{ $disregardPosts->count() }})</span>
        </div>
    
        <div id="pending-posts" class="tab-content active">
            @if($pendingPosts->isEmpty())
                <p>No pending posts yet.</p>
            @else
            @foreach ($pendingPosts as $post)
                <div class="pending-post-content">
                    <div class="pending-post-details">
                        <p>{{ $post->concern }}</p>
                        <p class="pending-post-date">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="pending-post-details">
                        <p class="pending-post-status">Status:</p>
                        <p class="status-text" data-status="{{ $post->status }}">{{ $post->status }}</p>
                    </div>
                </div>
            @endforeach
            @endif
        </div>
    
        <div id="disregarded-posts" class="tab-content" style="display: none;">
            @if($disregardPosts->isEmpty())
                <p>No disregarded posts yet.</p>
            @else
            @foreach ($disregardPosts as $post)
                <div class="disregard-post-content">
                    <div class="pending-post-details">
                        <p>{{ $post->concern }}</p>
                        <p class="pending-post-date">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="pending-post-details">
                        <p class="pending-post-status">Status:</p>
                        <p class="status-text" data-status="{{ $post->status }}">{{ $post->status }}</p>
                    </div>
                </div>
                <div class="disregard-reason">
                    <p>Reason: {{ $post->reasonDisregard }}</p>
                </div>
            @endforeach
            @endif
        </div>
    </div>
    
</div>