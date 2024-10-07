<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Posts;
use App\Models\ForumPosts;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Forum;
use App\Models\JoinForum;
use App\Models\Follow;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function showForgotPassPage()
    {
        return view('users.forgotPass');
    }
    public function showOtpPage()
    {
        return view('emails.otp');
    }

    // User Page
    public function showHomePage(Request $request)
    {
        $user = Auth::user();

        $filter = $request->input('filter', 'all');

        if ($filter === 'following') {
            $followingUserIds = \App\Models\Follow::where(
                'follower',
                $user->user_id
            )->pluck('following');

            $posts = Posts::with('user')
                ->withCount('likes', 'comments', 'bookmarks')
                ->where('status', 'Approved')
                ->whereIn('postedBy', $followingUserIds)
                ->orderBy('created_at', 'desc')
                ->get();
        } else {
            $posts = Posts::with('user')
                ->withCount('likes', 'comments', 'bookmarks')
                ->where('status', 'Approved')
                ->orderBy('created_at', 'desc')
                ->get();
        }

        return view('users.home', compact('posts'));
    }

    public function showArticlePage()
    {
        return view('users.article');
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

    public function showVisitForum($forum_id)
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

        $posts = ForumPosts::with('user')
            ->where('forum_id', $forum_id)
            ->withCount('likes', 'comments', 'bookmarks')
            ->orderBy('created_at', 'desc')
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
            compact('joinedVF')
        );
    }

    public function showNotificationPage()
    {
        return view('users.notification');
    }

    public function showSearchPage()
    {
        return view('users.search');
    }

    public function showResourcesPage()
    {
        return view('users.resources');
    }

    public function profilePageFunctions($user)
    {
        $following = Follow::where('follower', $user->user_id)
            ->with('followedUser')
            ->get();
        $followers = Follow::where('following', $user->user_id)
            ->with('followerUser')
            ->get();

        $followingCount = Follow::where('follower', $user->user_id)->count();
        $followerCount = Follow::where('following', $user->user_id)->count();

        $posts = Posts::where('postedBy', $user->user_id)
            ->withCount('likes', 'comments', 'bookmarks')
            ->where('status', 'Approved')
            ->orderBy('created_at', 'desc')
            ->get();

        $allPosts = Posts::with(
            'user',
            'comments',
            'comments.user',
            'comments.reply.user'
        )
            ->withCount('likes', 'comments', 'bookmarks')
            ->orderBy('created_at', 'desc')
            ->get();

        session(['allPosts' => $allPosts]);

        $pendingPosts = Posts::where('postedBy', $user->user_id)
        ->where('status', 'Pending')
        ->withCount('likes', 'comments', 'bookmarks')
        ->orderBy('created_at', 'desc')
        ->get();

        $disregardPosts = Posts::where('postedBy', $user->user_id)
        ->where('status', 'Disregard')
        ->withCount('likes', 'comments', 'bookmarks')
        ->orderBy('created_at', 'desc')
        ->get();

        $comments = Comment::where('user_id', $user->user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $likes = Posts::whereIn('post_id', function ($query) use ($user) {
            $query
                ->select('post_id')
                ->from('tbllikes')
                ->where('user_id', $user->user_id);
        })
            ->with(['user'])
            ->withCount('likes', 'comments', 'bookmarks')
            ->orderBy('created_at', 'desc')
            ->get();

        $bookmarks = Posts::whereIn('post_id', function ($query) use ($user) {
            $query
                ->select('post_id')
                ->from('tblbookmarks')
                ->where('user_id', $user->user_id);
        })
            ->with('user')
            ->withCount('likes', 'comments', 'bookmarks')
            ->orderBy('created_at', 'desc')
            ->get();

        return compact(
            'posts',
            'allPosts',
            'comments',
            'likes',
            'bookmarks',
            'following',
            'followers',
            'followingCount',
            'followerCount',
            'pendingPosts',
            'disregardPosts'
        );
    }
    public function showProfilePage()
    {
        $user = Auth::user();

        $profileFunctions = $this->profilePageFunctions($user);

        return view(
            'users.profile',
            array_merge(['user' => $user], $profileFunctions)
        );
    }

    public function showVisitProfilePage($user_id)
    {
        $user = UserAccount::where('user_id', $user_id)->firstOrFail();

        $profileFunctions = $this->profilePageFunctions($user);

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
        return view('settings.about_lawminary');
    }

    public function showAboutPAOPage()
    {
        return view('settings.about_pao');
    }

    public function showAccountPage()
    {
        return view('settings.account_settings');
    }

    public function showActLogsPage()
    {
        return view('settings.activity_logs');
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
