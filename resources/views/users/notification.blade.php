<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Notifications</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                    {{-- <div class="notification">
                        <a href="notifications"><i class="fas fa-bell bell-icon current"></i></a>
                    </div> --}}
                    <div class="notification">
                        <a href="notifications" class="notification-link">
                            <i class="fas fa-bell bell-icon current"></i>
                            <span id="notification-count" class="notification-badge"></span>
                        </a>
                    </div>                    
                </div>
                <hr class="divider">
            </header>
            <content>
                @include('inclusions/response')
                <h1>Notifications</h1>
                
                @if ($notificationsWithUsers->isEmpty())
                    <p class="empty-data">No notifications yet.</p>
                @else
                
                @foreach ($notificationsWithUsers as $item)
                    @php
                        $notification = $item['notification'];
                        $liker = $item['liker'];
                        $bookmarker = $item['bookmarker'];
                        $commenter = $item['commenter'];
                        $replier = $item['replier'];
                        $rater = $item['rater'];
                        $follower = $item['follower'];
                    @endphp
            
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
                                {{-- <div class="notifs-divider"></div> --}}
                                <div class="notifs-action">
                                    <span>{{ $liker->firstName }} {{ $notification->data['message'] }}</span>
                                    <span class="notifs-date">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <form action="{{ route('notification.delete', $notification->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>                           
                        </div>
                    @endif
                    
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
                                {{-- <div class="notifs-divider"></div> --}}
                                <div class="notifs-action">
                                    <span>{{ $bookmarker->firstName }} {{ $notification->data['message'] }}</span>
                                    <span class="notifs-date">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <form action="{{ route('notification.delete', $notification->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if ($commenter)
                        <div class="notifs btn-comment" data-post-id="{{ $notification->data['post_id'] }}">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="{{ $commenter->userPhoto ? Storage::url($commenter->userPhoto) : asset('imgs/user-img.png') }}" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="{{ Auth::check() && Auth::user()->user_id == $commenter->user_id ? route('profile') : route('visit-profile', ['user_id' => $commenter->user_id]) }}">
                                                {{ $commenter->firstName }} {{ $commenter->lastName }}
                                            </a>
                                        </h2>
                                        <p>@<span>{{ $commenter->username }}</span></p>
                                    </div>
                                </div>
                                {{-- <div class="notifs-divider"></div> --}}
                                <div class="notifs-action">
                                    <span>{{ $commenter->firstName }} {{ $notification->data['message'] }}</span>
                                    <span class="notifs-date">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <form action="{{ route('notification.delete', $notification->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if ($replier)
                        <div class="notifs btn-comment">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="{{ $replier->userPhoto ? Storage::url($replier->userPhoto) : asset('imgs/user-img.png') }}" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="{{ Auth::check() && Auth::user()->user_id == $replier->user_id ? route('profile') : route('visit-profile', ['user_id' => $replier->user_id]) }}">
                                                {{ $replier->firstName }} {{ $replier->lastName }}
                                            </a>
                                        </h2>
                                        <p>@<span>{{ $replier->username }}</span></p>
                                    </div>
                                </div>
                                {{-- <div class="notifs-divider"></div> --}}
                                <div class="notifs-action">
                                    <span>{{ $replier->firstName }} {{ $notification->data['message'] }}</span>
                                    <span class="notifs-date">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <form action="{{ route('notification.delete', $notification->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if ($rater)
                        <div class="notifs btn-comment">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="{{ $rater->userPhoto ? Storage::url($rater->userPhoto) : asset('imgs/user-img.png') }}" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="{{ Auth::check() && Auth::user()->user_id == $rater->user_id ? route('profile') : route('visit-profile', ['user_id' => $rater->user_id]) }}">
                                                {{ $rater->firstName }} {{ $rater->lastName }}
                                            </a>
                                        </h2>
                                        <p>@<span>{{ $rater->username }}</span></p>
                                    </div>
                                </div>
                                {{-- <div class="notifs-divider"></div> --}}
                                <div class="notifs-action">
                                    <span>{{ $rater->firstName }} {{ $notification->data['message'] }}</span>
                                    <span class="notifs-date">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <form action="{{ route('notification.delete', $notification->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif

                    @if ($follower)
                        <div class="notifs btn-comment">
                            <div class="notifs-content">
                                <div class="user-info">
                                    <img src="{{ $follower->userPhoto ? Storage::url($follower->userPhoto) : asset('imgs/user-img.png') }}" alt="Profile Picture" class="user-profile-photo" />
            
                                    <div class="notifs-info">
                                        <h2>
                                            <a href="{{ Auth::check() && Auth::user()->user_id == $follower->user_id ? route('profile') : route('visit-profile', ['user_id' => $follower->user_id]) }}">
                                                {{ $follower->firstName }} {{ $follower->lastName }}
                                            </a>
                                        </h2>
                                        <p>@<span>{{ $follower->username }}</span></p>
                                    </div>
                                </div>
                                {{-- <div class="notifs-divider"></div> --}}
                                <div class="notifs-action">
                                    <span>{{ $follower->firstName }} {{ $notification->data['message'] }}</span>
                                    <span class="notifs-date">{{ $notification->created_at->diffForHumans() }}</span>
                                </div>
                                <form action="{{ route('notification.delete', $notification->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none;">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endif
            
                @endforeach
                @endif
            </content>
        </main>
    </div>
    
    <script src="../js/settings.js"></script>    
    <script src="js/logout.js"></script>
</body>
</html>