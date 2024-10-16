<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Activity Logs</title>
        <link rel="icon" href="../../imgs/lawminarylogo_v3.png" type="image/png" />
        <link
            rel="stylesheet"
            href="{{ asset('css/settings/activity_logs_style.css') }}"
        />
        <link rel="stylesheet" href="{{ asset('css/nav_style.css') }}" />
        @include('inclusions/libraryLinks')
    </head>
    <body>
        <div class="container">
            @include('inclusions/userNav')
            <main>
                <header>
                    <div class="header-top">
                        @include('includes_syscon.syscon_logo_inc')
                        <div class="notification">
                            <a href="../notifications">
                                <i class="fas fa-bell bell-icon"></i>
                            </a>
                        </div>
                    </div>
                    <hr class="divider" />
                </header>
                <content>
                    <div class="log-header">
                        <i class="fa-solid fa-clock-rotate-left"></i>
                        <h1>Activity Logs</h1>
                    </div>

                    @if($activities->isEmpty())
                        <p>No activities found for this user.</p>
                    @else
                        @foreach($activities as $activity)
                            <div class="logs">
                                @if($activity->type === 'post')
                                    <p><strong>You Posted:</strong> Post ID {{ $activity->post_id }} on {{ $activity->created_at }}</p>
                                @elseif($activity->type === 'comment')
                                    <p><strong>You Commented:</strong> Comment ID {{ $activity->comment_id }} on Post ID {{ $activity->post_id }} on {{ $activity->created_at }}</p>
                                @elseif($activity->type === 'like')
                                    <p><strong>You Liked:</strong> Post ID {{ $activity->post_id }} on {{ $activity->created_at }}</p>
                                @elseif($activity->type === 'bookmark')
                                    <p><strong>You Bookmarked:</strong> Post ID {{ $activity->post_id }} on {{ $activity->created_at }}</p>
                                @elseif($activity->type === 'point')
                                    <p><strong>You Earned Points:</strong> {{ $activity->points }} on {{ $activity->created_at }}</p>
                                @elseif($activity->type === 'rate')
                                    <p><strong>You Rated:</strong> {{ $activity->rate }} stars on {{ $activity->created_at }}</p>
                                @elseif($activity->type === 'forum_post')
                                    <p><strong>You Forum Post:</strong> Forum ID {{ $activity->forum_id }} on {{ $activity->created_at }}</p>
                                @elseif($activity->type === 'forum_member')
                                    <p><strong>You Joined Forum:</strong> Forum ID {{ $activity->forum_id }} on {{ $activity->created_at }}</p>
                                @elseif($activity->type === 'following')
                                    <p><strong>You Followed:</strong> User ID {{ $activity->following }} on {{ $activity->created_at }}</p>
                                @elseif($activity->type === 'follower')
                                    <p><strong>You Was Followed by:</strong> User ID {{ $activity->follower }} on {{ $activity->created_at }}</p>
                                @endif
                                <a type="button">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        @endforeach
                    @endif
                </content>
            </main>
        </div>
        <script src="../js/settings.js"></script>
        <script src="../js/logout.js"></script>
    </body>
</html>
