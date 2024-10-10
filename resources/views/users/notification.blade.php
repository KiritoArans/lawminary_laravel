<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Notifications</title>
    <link rel="icon" href="../imgs/lawminarylogo_v3.png" type="image/png">
    <link rel="stylesheet" href="{{ asset ('css/notification_style.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/nav_style.css') }}">
    @include('inclusions/libraryLinks')
</head>
<body>
    <div class="container">
        @include('inclusions/userNav')
        <main>
            <header>
                <div class="header-top">
                    <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
                    <div class="notification">
                        <a href="notifications"><i class="fas fa-bell bell-icon current"></i></a>
                    </div>
                </div>
                <hr class="divider">
            </header>
            <content>
                <h1>Notifications</h1>
                @foreach ($notificationsWithUsers as $item)
                    @php
                        $notification = $item['notification'];
                        $liker = $item['liker'];
                        $bookmarker = $item['bookmarker'];
                    @endphp
            
                    <!-- If the notification has a liker -->
                    @if ($liker)
                        <div class="notifs btn-comment" data-post-id="{{ $notification->data['post_id'] }}">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="{{ $liker->userPhoto ? Storage::url($liker->userPhoto) : asset('imgs/user-img.png') }}" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="{{ Auth::check() && Auth::user()->user_id == $liker->user_id ? route('profile') : route('visit-profile', ['user_id' => $liker->user_id]) }}">
                                                {{ $liker->firstName }} {{ $liker->lastName }}
                                            </a>
                                        </h2>
                                        <p>@<span>{{ $liker->username }}</span></p>
                                    </div>
                                </div>
                                <div class="notifs-divider"></div>
                                <div class="notifs-action">
                                    <span>{{ $notification->data['message'] }}</span>
                                </div>
                                <span class="notifs-date">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endif
            
                    <!-- If the notification has a bookmarker -->
                    @if ($bookmarker)
                        <div class="notifs btn-comment" data-post-id="{{ $notification->data['post_id'] }}">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="{{ $bookmarker->userPhoto ? Storage::url($bookmarker->userPhoto) : asset('imgs/user-img.png') }}" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="{{ Auth::check() && Auth::user()->user_id == $bookmarker->user_id ? route('profile') : route('visit-profile', ['user_id' => $bookmarker->user_id]) }}">
                                                {{ $bookmarker->firstName }} {{ $bookmarker->lastName }}
                                            </a>
                                        </h2>
                                        <p>@<span>{{ $bookmarker->username }}</span></p>
                                    </div>
                                </div>
                                <div class="notifs-divider"></div>
                                <div class="notifs-action">
                                    <span>{{ $notification->data['message'] }}</span>
                                </div>
                                <span class="notifs-date">{{ $notification->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    @endif
            
                @endforeach
            </content>
            
            
        </main>
    </div>
    <script src="js/postandcomment.js"></script>
    <script src="../js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html>