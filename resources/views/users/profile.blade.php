<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Profile</title>
        <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png" />
        <link rel="stylesheet" href="{{ asset('css/profile_style.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        <link
            rel="stylesheet"
            href="{{ asset('css/otherstyles/posts_style.css') }}"
        />
        @include('inclusions/libraryLinks')
        @include('inclusions/broadcastJS')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="notifications" class="notification-link">
                                <i class="fas fa-bell bell-icon current"></i>
                                <span id="notification-count" class="notification-badge"></span>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>

                <content >
                    <div class="profile-section">
                        <div class="profile-header">
                            <div class="profile-details">
                                <div class="profile-left">
                                    <img
                                        src="{{ Auth::user()->userPhoto ? Storage::url(Auth::user()->userPhoto) : asset('imgs/user-img.png') }}"
                                        class="profile-photo"
                                        alt="Profile Picture"/>
                                    <div class="profile-info">
                                        <div class="profile-names">
                                            <h2>
                                                {{ $user->accountType === 'Lawyer' ? 'Atty. ' : '' }}
                                                {{ $user->firstName }} {{ $user->lastName }}
                                            </h2>
                                            @if ($user->accountType === 'Lawyer')
                                                <a href="/leaderboards">
                                                    @if (strtolower($rank) === 'Wood')
                                                        <img src="{{ asset('imgs/badges/wood.png') }}" alt="Wood Badge" width="10" class="badge-rank" title="Wood Badge">
                                                    @else
                                                        <img src="{{ asset('imgs/badges/' . strtolower($rank) . '.png') }}" alt="{{ $rank }} Badge" width="10" class="badge-rank" title="{{ $rank }} Badge">
                                                    @endif
                                                </a>
                                            @endif
                                        </div>
                                        <h4>@<span>{{ $user->username }}</span></h4>
                                        <div class="profile-badge">
                                            <span class="badge">
                                                {{ $user->accountType }}{{ $user->accountType === 'Lawyer' ? ' | ' . $averageRating : '' }}
                                            </span>                                    
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-right">
                                    <div class="profile-stats">
                                        <div class="following-count">
                                            <span>Following:</span>
                                            <span>{{ $followingCount }}</span>
                                        </div>
                                        <div class="follower-count">
                                            <span>Followers:</span>
                                            <span>{{ $followerCount }}</span>
                                        </div>
                                        <a href="account-settings" class="edit-profile-button">
                                            Edit Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="hr1">
                        <div class="profile-nav">
                            <ul>
                                <li id="posts-link"><a >Posts</a></li>
                                <li id="comments-link"><a >Comments</a></li>
                                <li id="liked-link"><a>Likes</a></li>
                                <li id="bookmarked-link"><a>Bookmarks</a></li>
                            </ul>
                        </div>
                    
                    </div>

                    <div class="profile-content">

                        @include('inclusions/profile/profileFollowModal')

                        @include('inclusions/profile/profilePosts')

                        @include('inclusions/openComments')

                        @include('inclusions/rateCommentModal')

                        @include('inclusions/profile/profileCommsReps')

                        @include('inclusions/profile/profileLikes')

                        @include('inclusions/profile/profileBookmarks')

                        @include('inclusions/reportPostModal')

                    </div>

                    @include('inclusions/profile/penPostModal')
                    
                    @include('inclusions/createPostModal')

                </content>
            </main>
        </div>
        <script src="js/followModal.js"></script>
        <script src="js/postandcomment.js"></script>

        <script src="js/likePost.js"></script>
        <script src="js/bookmarkPost.js"></script>
        <script src="js/commentPost.js"></script>
        <script src="js/replyPost.js"></script>
        <script src="js/rateComment.js"></script>

        <script src="js/followUser.js"></script>

        <script src="js/reportPost.js"></script>
        
        <script src="js/pendingPost.js"></script>

        <script src="js/showNotification.js"></script>
        
        <script src="js/settings.js"></script>
        <script src="js/profile.js"></script>
        <script src="js/logout.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const sortFilter = document.getElementById('sortFilter');
                const postsContainer = document.getElementById('posts-container');

                sortFilter.addEventListener('change', function () {
                    const selectedValue = this.value;
                    let postsArray = Array.from(postsContainer.children); // Convert NodeList to an array

                    // Sort the posts based on the selected value (newest or oldest)
                    postsArray.sort(function (a, b) {
                        const timeA = new Date(a.getAttribute('data-post-time'));
                        const timeB = new Date(b.getAttribute('data-post-time'));

                        if (selectedValue === 'newest') {
                            return timeB - timeA; // Sort descending (newest first)
                        } else if (selectedValue === 'oldest') {
                            return timeA - timeB; // Sort ascending (oldest first)
                        }
                    });

                    // Re-append sorted posts to the container
                    postsArray.forEach(function (post) {
                        postsContainer.appendChild(post);
                    });
                });
            });
        </script>
    </body>
</html>
