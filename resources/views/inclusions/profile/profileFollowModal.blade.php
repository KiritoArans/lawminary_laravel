<div id="followModal" class="followModal">
    <div class="followModal-content">
        <span class="close">&times;</span>
        <h2 class="modal-title">Followers and Following</h2>
        <div class="modal-nav">
            <span id="followers-tab" class="active">Followers</span>
            <span id="following-tab">Following</span>
        </div>
        <div class="search-bar">
            <input type="text" placeholder="Search">
        </div>
        
        <ul id="followers-list" class="user-list">
            @foreach($followers as $follower)
            <li>
                <img src="{{ $follower->followerUser->userPhoto ? Storage::url($follower->followerUser->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Photo" class="user-profile-photo">
                <div class="user-info">
                    <a href="{{ Auth::check() && Auth::user()->user_id == $follower->followerUser->user_id ? route('profile') : route('visit-profile', ['user_id' => $follower->followerUser->user_id]) }}">
                        <span class="fullname">{{ $follower->followerUser->firstName }} {{ $follower->followerUser->lastName }}</span>
                    </a>
                </div>
                @if(Auth::user()->user_id != $follower->followerUser->user_id)
                @php
                    $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)
                        ->where('following', $follower->followerUser->user_id)
                        ->exists();
                @endphp
                <form action="{{ route('followUser') }}" method="POST" style="display:inline;">
                    @csrf
                    @include('inclusions/response')
                    <input type="hidden" name="following" value="{{ $follower->followerUser->user_id }}">
                    
                    <button class="follow-btn {{ $haveFollowed ? 'following' : '' }}">
                        {{ $haveFollowed ? 'Unfollow' : 'Follow' }}
                    </button>
                </form>
                @endif
            </li>
            @endforeach
        </ul>

        <ul id="following-list" class="user-list" style="display: none;">
            @foreach($following as $follow)
            <li>
                <img src="{{ $follow->followedUser->userPhoto ? Storage::url($follow->followedUser->userPhoto) : '../imgs/user-img.png' }}" alt="Profile Photo" class="user-profile-photo">
                <div class="user-info">
                    <a href="{{ Auth::check() && Auth::user()->user_id == $follow->followedUser->user_id ? route('profile') : route('visit-profile', ['user_id' => $follow->followedUser->user_id]) }}">
                        <span class="fullname">{{ $follow->followedUser->firstName }} {{ $follow->followedUser->lastName }}</span>
                    </a>
                </div>
                @if(Auth::user()->user_id != $follow->followedUser->user_id)
                @php
                    $haveFollowed = \App\Models\Follow::where('follower', Auth::user()->user_id)
                        ->where('following', $follow->followedUser->user_id)
                        ->exists();
                @endphp
                <form action="{{ route('followUser') }}" method="POST" style="display:inline;">
                    @csrf
                    @include('inclusions/response')
                    <input type="hidden" name="following" value="{{ $follow->followedUser->user_id }}">
                    
                    <button class="follow-btn {{ $haveFollowed ? 'following' : '' }}">
                        {{ $haveFollowed ? 'Unfollow' : 'Follow' }}
                    </button>
                </form>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</div>