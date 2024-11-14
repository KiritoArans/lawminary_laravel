<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BookTwoLaws;
use App\Models\UserAccount;
use App\Models\Posts;
use App\Models\ForumPosts;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Forum;
use App\Models\JoinForum;
use App\Models\Follow;
use App\Models\Leaderboard;
use App\Models\Point;
use App\Models\SystemContent;
use App\Http\Controllers\LeaderboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class PageController extends Controller
{
    // Login & Sign up
    public function showLoginPage()
    {
        return view('users.login');
    }

    public function showSignupPage()
    {
        return view('users.signup');
    }
    public function showLawyerSignupPage()
    {
        return view('users.lawyerSignup');
    }

    public function showForgotPassPage()
    {
        return view('users.forgotPass');
    }
    public function showOtpPage()
    {
        return view('emails.otp');
    }

    public function showViewPostPage(Request $request, $post_id)
    {
        $user = Auth::user();

        $post = Posts::with('user', 'comments', 'comments.user', 'comments.reply.user')
            ->withCount('likes', 'comments', 'bookmarks')
            ->where('post_id', $post_id)
            ->first();

        if (!$post) {
            $forumPost = ForumPosts::with('user', 'comments', 'comments.user', 'comments.reply.user')
                ->withCount('likes', 'comments', 'bookmarks')
                ->where('post_id', $post_id)
                ->first();

            if ($forumPost) {
                return redirect()->route('forum-view', ['post_id' => $post_id]);
            }

            return redirect()->back()->with('error', 'Post not found.');
        }

        return view('users.viewPost', compact('post'));
    }

    
    public function showForumViewPostPage(Request $request, $post_id)
    {
        $user = Auth::user();

        $post = ForumPosts::with('user', 'comments', 'comments.user', 'comments.reply.user')
            ->withCount('likes', 'comments', 'bookmarks')
            ->where('post_id', $post_id)
            ->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');

        }

        return view('users.viewForumPost', compact('post'));
    }
    


    // User Page
    public function showHomePage(Request $request)
    {
        $user = Auth::user();

        $filter = $request->input('filter', 'all');

        $allPosts = Posts::with(
            'user',
            'comments',
            'comments.user',
            'comments.reply.user'
            )
                ->withCount('likes', 'comments', 'bookmarks')
                ->whereHas('user')
                ->orderBy('created_at', 'desc')
                ->get();

            if ($filter === 'following') {
                $followingUserIds = \App\Models\Follow::where(
                    'follower',
                    $user->user_id
                )->pluck('following');

                $posts = Posts::with('user')
                    ->withCount('likes', 'comments', 'bookmarks')
                    ->where('status', 'Approved')
                    ->where('privacy', 'Public')
                    ->whereIn('postedBy', $followingUserIds)
                    ->whereHas('user')
                    ->orderBy('created_at', 'desc')
                    ->get();
            } else {
                $posts = Posts::with('user')
                    ->withCount('likes', 'comments', 'bookmarks')
                    ->where('status', 'Approved')
                    ->where('privacy', 'Public')
                    ->whereHas('user')
                    ->orderBy('created_at', 'desc')
                    ->get();
        }

        return view('users.home', compact('posts', 'allPosts'));
    }

    public function showHomeSearchPage()
    {
        return view('users.home-search');
    }

    public function showArticlePage(Request $request)
    {
        $searchTerm = $request->input('query');
        
        if ($searchTerm) {
            // No pagination for search results
            $articles = DB::table('tblbooktwo')
                ->where('article_name', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('description', 'LIKE', '%' . $searchTerm . '%')
                ->orWhere('title', 'LIKE', '%' . $searchTerm . '%')
                ->get();
        } else {
            // Paginate for default view
            $articles = DB::table('tblbooktwo')
                ->inRandomOrder()
                ->paginate(3); // Adjust the number of articles per page
        }
    
        return view('users.article', compact('articles', 'searchTerm'));
    }
    
    
    
    
    public function showLeaderboardsPage()
    {
        $lawyers = DB::table('tblpoints')
            ->join(
                'tblaccounts',
                'tblpoints.lawyerUser_id',
                '=',
                'tblaccounts.user_id'
            ) 
            ->select(
                'tblpoints.lawyerUser_id',
                'tblaccounts.username',
                DB::raw('SUM(tblpoints.points) as total_points')
            )
            ->groupBy('tblpoints.lawyerUser_id', 'tblaccounts.username') 
            ->get();

        // Iterate through the list of lawyers and assign rank
        foreach ($lawyers as $lawyer) {
            $rank = '';

            // Assign badge based on total points
            if ($lawyer->total_points >= 5000) {
                $rank = 'Diamond';
            } elseif ($lawyer->total_points >= 3500) {
                $rank = 'Gold';
            } elseif ($lawyer->total_points >= 2000) {
                $rank = 'Silver';
            } elseif ($lawyer->total_points >= 1000) {
                $rank = 'Bronze';
            } elseif ($lawyer->total_points >= 500) {
                $rank = 'Steel';
            } else {
                $rank = 'Wood';
            }

            Leaderboard::updateOrInsert(
                ['lawyerUser_id' => $lawyer->lawyerUser_id],
                [
                    'username' => $lawyer->username, 
                    'rankPoints' => $lawyer->total_points,
                    'rank' => $rank,
                    'updated_at' => now(),
                ]
            );
        }
        // Retrieve the leaderboards data along with user name by joining with tblaccounts
        $leaderboards = DB::table('tblleaderboards')
            ->join('tblaccounts', 'tblleaderboards.lawyerUser_id', '=', 'tblaccounts.user_id')
            ->select('tblleaderboards.*', 'tblaccounts.username', 'tblaccounts.firstName', 'tblaccounts.lastName')
            ->orderBy('tblleaderboards.rankPoints', 'desc')
            ->take(10)
            ->get();


        $currentUser = auth()->user();
        $userRank = null;
        $userRankPoints = null;
        
            if ($currentUser && $currentUser->accountType === 'Lawyer') {
                $userData = DB::table('tblleaderboards')
                    ->where('lawyerUser_id', $currentUser->user_id)
                    ->first(['rank', 'rankPoints']);
        
                if ($userData) {
                    $userRank = $userData->rank;
                    $userRankPoints = $userData->rankPoints;
                }
            }
        

        return view('users.leaderboards', compact('leaderboards', 'userRank', 'userRankPoints'));
    } 

    public function forumFunctions($user)
    {
        $discoverForum = DB::table('tblforums')
            ->leftJoin(
                'tblforummembers',
                'tblforums.forum_id',
                '=',
                'tblforummembers.forum_id'
            )
            ->select(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumPhoto',
                'tblforums.forumDesc',
                DB::raw('COUNT(tblforummembers.forum_id) as membersCount')
            )
            ->whereNotIn('tblforums.forum_id', function ($query) use ($user) {
                $query
                    ->select('forum_id')
                    ->from('tblforummembers')
                    ->where('user_id', $user->user_id);
            })
            ->groupBy(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumPhoto',
                'tblforums.forumDesc'
            )
            ->orderBy('tblforums.created_at', 'desc')
            ->get();

        $forums = DB::table('tblforums')
            ->leftJoin(
                'tblforummembers',
                'tblforums.forum_id',
                '=',
                'tblforummembers.forum_id'
            )
            ->select(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumPhoto',
                'tblforums.forumDesc',
                DB::raw('COUNT(tblforummembers.forum_id) as membersCount')
            )
            ->groupBy(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumPhoto',
                'tblforums.forumDesc'
            )
            ->orderBy('tblforums.created_at', 'desc')
            ->get();

        $joinedForum = DB::table('tblforums')
            ->leftJoin(
                'tblforummembers',
                'tblforums.forum_id',
                '=',
                'tblforummembers.forum_id'
            )
            ->select(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumPhoto',
                'tblforums.forumDesc',
                DB::raw('COUNT(tblforummembers.forum_id) as membersCount')
            )
            ->whereIn('tblforums.forum_id', function ($query) use ($user) {
                $query
                    ->select('forum_id')
                    ->from('tblforummembers')
                    ->where('user_id', $user->user_id);
            })
            ->groupBy(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumPhoto',
                'tblforums.forumDesc'
            )
            ->orderBy('tblforums.created_at', 'desc')
            ->get();

        $joined = [];
        foreach ($forums as $forum) {
            $joined[$forum->forum_id] = JoinForum::where(
                'user_id',
                $user->user_id
            )
                ->where('forum_id', $forum->forum_id)
                ->exists();
        }

        return compact('forums', 'discoverForum', 'joinedForum', 'joined');
    }

    public function showForumsPage()
    {
        $user = Auth::user();

        $forumFunctions = $this->forumFunctions($user);

        return view(
            'users.forums',
            array_merge(['user' => $user], $forumFunctions)
        );
    }

    public function showVisitForum(Request $request, $forum_id)
    {
        $user = Auth::user();

        $forumFunctions = $this->forumFunctions($user);

        $activeForum = DB::table('tblforums')
            ->leftJoin(
                'tblforummembers',
                'tblforums.forum_id',
                '=',
                'tblforummembers.forum_id'
            )
            ->select(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumPhoto',
                'tblforums.forumDesc',
                'tblforums.created_at',
                'tblforums.updated_at',
                DB::raw('COUNT(tblforummembers.forum_id) as membersCount')
            )
            ->where('tblforums.forum_id', $forum_id)
            ->groupBy(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumPhoto',
                'tblforums.forumDesc',
                'tblforums.created_at',
                'tblforums.updated_at'
            )
            ->first();

        $sortOrder = $request->input('sort', 'desc'); // Default to 'desc' (Newest)

        $searchQuery = $request->input('search');

        $posts = ForumPosts::with('user')
            ->where('forum_id', $forum_id)
            ->when($searchQuery, function($query) use ($searchQuery) {
                return $query->where('concern', 'like', '%' . $searchQuery . '%')
                            ->orWhereHas('user', function($q) use ($searchQuery) {
                                $q->where('firstName', 'like', '%' . $searchQuery . '%')
                                ->orWhere('lastName', 'like', '%' . $searchQuery . '%'); // Added lastName condition
                            });
            })
            ->withCount('likes', 'comments', 'bookmarks')
            ->orderBy('created_at', $sortOrder) 
            ->get();

        $allPosts = ForumPosts::with(
            'user',
            'comments',
            'comments.user',
            'comments.reply.user'
        )
        ->withCount('likes', 'comments', 'bookmarks')
        ->orderBy('created_at', 'desc')
        ->get();

        $joinedVF = JoinForum::where('user_id', $user->user_id)
            ->where('forum_id', $forum_id)
            ->exists();

        return view(
            'users.visit_forums',
            array_merge(
                [
                    'activeForum' => $activeForum,
                    'posts' => $posts,
                    'allPosts' => $allPosts,
                ],
                $forumFunctions
            ),
            compact('joinedVF', 'sortOrder', 'searchQuery') 
        );
    }

    public function showNotificationPage()
    {
        $notifications = auth()->user()->notifications()->get();
        
        // Count unread notifications
        $unreadNotificationsCount = auth()->user()->unreadNotifications()->count();
        
        // Mark all unread notifications as read when the page is loaded
        auth()->user()->unreadNotifications->markAsRead();
        
        // Prepare notifications with associated user information
        $notificationsWithUsers = $notifications->map(function ($notification) {
            $data = $notification->data;
            
            return [
                'notification' => $notification,
                'liker' => isset($data['liker_id']) ? UserAccount::find($data['liker_id']) : null,
                'bookmarker' => isset($data['bookmarker_id']) ? UserAccount::find($data['bookmarker_id']) : null,
                'commenter' => isset($data['commenter_id']) ? UserAccount::find($data['commenter_id']) : null,
                'replier' => isset($data['replier_id']) ? UserAccount::find($data['replier_id']) : null,
                'rater' => isset($data['rater_id']) ? UserAccount::find($data['rater_id']) : null,
                'follower' => isset($data['follower_id']) ? UserAccount::find($data['follower_id']) : null,
                'approver' => isset($data['approver_id']) ? UserAccount::find($data['approver_id']) : null,
                'status' => isset($data['status']) ? $data['status'] : null,

            ];
        });

        $allPosts = Posts::with(
            'user',
            'comments',
            'comments.user',
            'comments.reply.user'
        )
            ->withCount('likes', 'comments', 'bookmarks')
            ->whereNotNull('post_id') 
            ->orderBy('created_at', 'desc')
            ->get();
        
        
        return view('users.notification', [
            'notificationsWithUsers' => $notificationsWithUsers,
            'unreadNotificationsCount' => $unreadNotificationsCount,
            'allPosts' => $allPosts
        ]);
    }

    public function showSearchLawPage(Request $request)
    {
        $request->validate([
            'user_concern' => 'required|string|max:255',
        ]);

        $userConcern = $request->input('user_concern');
        $possibleCharges = [];

        if ($userConcern) {

            $normalizedConcern = strtolower(trim($userConcern));
            $stopWords = ['the', 'what', 'and', 'a', 'of', 'in', 'on', 'at', 'for', 'to', 'is', 'with', 'i', 'you', 'my', 'person', 'man', 'me', 'them'];
            $keywords = array_diff(explode(' ', $normalizedConcern), $stopWords);

            $possibleCharges = BookTwoLaws::where(function ($query) use ($normalizedConcern, $keywords) {
                $query->where(function ($subQuery) use ($normalizedConcern) {
                    $subQuery->whereRaw("LOWER(article_name) LIKE ?", ["%$normalizedConcern%"])
                            ->orWhereRaw("LOWER(chapter_name) LIKE ?", ["%$normalizedConcern%"])
                            ->orWhereRaw("LOWER(section_name) LIKE ?", ["%$normalizedConcern%"])
                            ->orWhereRaw("LOWER(description) LIKE ?", ["%$normalizedConcern%"])
                            ->orWhereRaw("LOWER(TRIM(TRAILING ',' FROM synonyms)) LIKE ?", ["%$normalizedConcern%"]);
                });

                foreach ($keywords as $keyword) {
                    $query->orWhere(function ($subQuery) use ($keyword) {
                        $subQuery->whereRaw("LOWER(article_name) LIKE ?", ["%$keyword%"])
                                ->orWhereRaw("LOWER(chapter_name) LIKE ?", ["%$keyword%"])
                                ->orWhereRaw("LOWER(section_name) LIKE ?", ["%$keyword%"])
                                ->orWhereRaw("LOWER(description) LIKE ?", ["%$keyword%"])
                                ->orWhereRaw("FIND_IN_SET(LOWER(TRIM(?)), TRIM(TRAILING ',' FROM synonyms)) > 0", [trim($keyword)]);
                    });
                }

                foreach ($keywords as $keyword) {
                    $query->orWhereRaw("LOWER(TRIM(TRAILING ',' FROM synonyms)) LIKE ?", ["%$keyword%"]);
                }
            })
            ->select('title_name', 'chapter_name', 'article_name', 'section_name', 'description', 'article_no')
            ->orderByRaw("
                (CASE 
                    WHEN LOWER(article_name) LIKE '%$normalizedConcern%' THEN 5
                    WHEN LOWER(TRIM(TRAILING ',' FROM synonyms)) LIKE '%$normalizedConcern%' THEN 4
                    WHEN LOWER(chapter_name) LIKE '%$normalizedConcern%' THEN 3
                    WHEN LOWER(section_name) LIKE '%$normalizedConcern%' THEN 2
                    WHEN LOWER(description) LIKE '%$normalizedConcern%' THEN 1
                    ELSE 0
                END) DESC,
                (CASE 
                    WHEN FIND_IN_SET(LOWER(TRIM(?)), TRIM(TRAILING ',' FROM synonyms)) > 0 THEN 1
                    ELSE 0
                END) DESC
            ", [$normalizedConcern])
            ->limit(16)
            ->get();
        }

        return view('users.search-law', ['possibleCharges' => $possibleCharges]);
    }

    public function showResourcesPage()
    {
        return view('users.resources');
    }

    public function profilePageFunctions(Request $request, $user)
    {
        $following = Follow::where('follower', $user->user_id)
            ->with('followedUser')
            ->get();
        $followers = Follow::where('following', $user->user_id)
            ->with('followerUser')
            ->get();

        $followingCount = Follow::where('follower', $user->user_id)->count();
        $followerCount = Follow::where('following', $user->user_id)->count();


        $averageRating = DB::table('tblrates')
        ->where('lawyerUser_id', $user->user_id)
        ->avg('rate');

        // If no ratings exist, default the average to 0 or N/A
        $averageRating = $averageRating ? number_format($averageRating, 1) : 'N/A';


        $leaderboard = DB::table('tblleaderboards')
            ->where('lawyerUser_id', $user->user_id)
            ->first();

        // Default rank if the user is not found in the leaderboard
        $rank = $leaderboard ? $leaderboard->rank : 'No Rank';

        $sortOrder = $request->input('sort', 'desc'); // Default to 'desc' (Newest)

        $vPosts = Posts::where('postedBy', $user->user_id)
            ->withCount('likes', 'comments', 'bookmarks')
            ->where('status', 'Approved')
            ->where('privacy', 'Public')
            ->orderBy('created_at', $sortOrder)
            ->get();

        $posts = Posts::where('postedBy', $user->user_id)
            ->withCount('likes', 'comments', 'bookmarks')
            ->where('status', 'Approved')
            ->orderBy('created_at', $sortOrder)
            ->get();

        $allPosts = Posts::with(
            'user',
            'comments',
            'comments.user',
            'comments.reply.user'
        )
            ->withCount('likes', 'comments', 'bookmarks')
            ->where('privacy', 'Public')
            ->orderBy('created_at', 'desc')
            ->get();

        session(['allPosts' => $allPosts]);

        $pendingPosts = Posts::where('postedBy', $user->user_id)
        ->where('status', 'Pending')
        ->withCount('likes', 'comments', 'bookmarks')
        ->orderBy('created_at', 'desc')
        ->get();

        $disregardPosts = Posts::where('postedBy', $user->user_id)
        ->where('status', 'Disregarded')
        ->withCount('likes', 'comments', 'bookmarks')
        ->orderBy('created_at', 'desc')
        ->get();

        $comments = Comment::where('user_id', $user->user_id)
            ->whereIn('post_id', function($query) {
                $query->select('post_id')
                    ->from('tblposts'); 
            })
            ->orderBy('created_at', 'desc')
            ->get();


        $likes = Posts::whereIn('tblposts.post_id', function ($query) use ($user) {
                $query
                    ->select('post_id')
                    ->from('tbllikes')
                    ->where('user_id', $user->user_id);
            })
            ->join('tbllikes', 'tblposts.post_id', '=', 'tbllikes.post_id')
            ->where('tbllikes.user_id', $user->user_id)
            ->where('privacy', 'Public')
            ->with(['user'])
            ->withCount('likes', 'comments', 'bookmarks')
            ->orderBy('tbllikes.created_at', 'desc') 
            ->get();
    

        $bookmarks = Posts::whereIn('tblposts.post_id', function ($query) use ($user) {
                $query
                    ->select('post_id')
                    ->from('tblbookmarks')
                    ->where('user_id', $user->user_id);
            })
            ->join('tblbookmarks', 'tblposts.post_id', '=', 'tblbookmarks.post_id')
            ->where('tblbookmarks.user_id', $user->user_id)
            ->where('privacy', 'Public')
            ->with('user')
            ->withCount('likes', 'comments', 'bookmarks')
            ->orderBy('tblbookmarks.created_at', 'desc') 
            ->get();

            
        $helpedUserCount = Comment::where('user_id', $user->user_id)
            ->distinct('post_id')
            ->count('post_id');

        return compact(
            'sortOrder',
            'posts',
            'vPosts',
            'allPosts',
            'comments',
            'likes',
            'bookmarks',
            'averageRating',
            'rank',
            'following',
            'followers',
            'followingCount',
            'followerCount',
            'pendingPosts',
            'disregardPosts',
            'helpedUserCount'
        );
    }
    public function showProfilePage(Request $request)
    {
        $user = Auth::user();

        $profileFunctions = $this->profilePageFunctions($request, $user);

        return view(
            'users.profile',
            array_merge(['user' => $user], $profileFunctions)
        );
    }

    public function showVisitProfilePage(Request $request, $user_id)
    {
        $user = UserAccount::where('user_id', $user_id)->firstOrFail();

        $profileFunctions = $this->profilePageFunctions($request, $user);

        $isFollowing = \App\Models\Follow::where('follower', $user->user_id)
            ->where('following', $user->user_id)
            ->exists();

        return view(
            'users.visit_profile',
            array_merge(['user' => $user], $profileFunctions),
            compact('isFollowing')
        );
    }

    // Settings
    public function showAboutLawminaryPage()
    {
        $sysconData = SystemContent::all();
    
        return view('settings.about_lawminary', [
            'sysconData' => $sysconData,
        ]);
    }

    public function showAboutPAOPage()
    {
        $sysconData = SystemContent::all();
    
        return view('settings.about_pao', [
            'sysconData' => $sysconData,
        ]);
    }

    public function showAccountPage()
    {
        return view('settings.account_settings');
    }

    public function showActLogsPage(Request $request)
    {
        $user_id = Auth::user()->user_id; 
        
        $sortOrder = $request->input('sort', 'desc'); // Default to 'desc' (Newest)
        // 1. Get activities from different tables
    
        // Posts
        $followings = DB::table('tblfollowings')
            ->where('follower', $user_id)  // Fetch where the user is the follower
            ->orWhere('following', $user_id) // Fetch where the user is being followed
            ->select('follower', 'following', 'created_at', 'updated_at', DB::raw("'following' as type"))
            ->get();

        $posts = DB::table('tblposts')
            ->where('postedBy', $user_id)
            ->select('post_id', 'concern', 'created_at', 'updated_at', DB::raw("'post' as type"))
            ->get();
    
        // Comments
        $comments = DB::table('tblcomments')
            ->where('user_id', $user_id)
            ->select('comment_id', 'post_id', 'created_at', 'updated_at', DB::raw("'comment' as type"))
            ->get();
    
        // Likes
        $likes = DB::table('tbllikes')
            ->where('user_id', $user_id)
            ->select('post_id', 'created_at', 'updated_at', DB::raw("'like' as type"))
            ->get();
    
        // Bookmarks
        $bookmarks = DB::table('tblbookmarks')
            ->where('user_id', $user_id)
            ->select('post_id', 'created_at', 'updated_at', DB::raw("'bookmark' as type"))
            ->get();
    
        // Points (if user has points activity)
        $points = DB::table('tblpoints')
            ->where('lawyerUser_id', $user_id)
            ->select('id', 'points', 'created_at', 'updated_at', DB::raw("'point' as type"))
            ->get();
    
        // Ratings (if user has ratings activity)
        $ratings = DB::table('tblrates')
            ->where('user_id', $user_id)
            ->select('id', 'rate', 'created_at', 'updated_at', DB::raw("'rate' as type"))
            ->get();
    
        // Forum Posts (if user participated in forums)
        $forumPosts = DB::table('tblforumposts')
            ->where('postedBy', $user_id)
            ->select('forum_id', 'created_at', 'updated_at', DB::raw("'forum_post' as type"))
            ->get();
    
        // Forum Memberships (if user is a member of any forums)
        $forumMemberships = DB::table('tblforummembers')
            ->where('user_id', $user_id)
            ->select('forum_id', 'created_at', 'updated_at', DB::raw("'forum_member' as type"))
            ->get();
    
        // 2. Merge and sort all activities
    
        $activities = collect()
            ->merge($followings)
            ->merge($posts)
            ->merge($comments)
            ->merge($likes)
            ->merge($bookmarks)
            ->merge($points)
            ->merge($ratings)
            ->merge($forumPosts)
            ->merge($forumMemberships);
    

        $sortedActivities = $sortOrder === 'asc'
            ? $activities->sortBy('created_at')->values()
            : $activities->sortByDesc('created_at')->values();

        // 3. Pass the sorted activities to the view
        return view('settings.activity_logs', ['activities' => $sortedActivities]);
    }

    public function showFeedbackPage()
    {
        return view('settings.provide_feedback');
    }

    public function showTOSPage()
    {
        return view('settings.tos');
    }
}
