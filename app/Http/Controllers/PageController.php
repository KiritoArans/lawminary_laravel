<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Posts;
use App\Models\Like;
use App\Models\Comment;
use App\Models\Forum;
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


    // User Page
    public function showHomePage(Request $request)
    {
        $user = Auth::user();
    
        $filter = $request->input('filter', 'all');
    
        if ($filter === 'following') {
            $followingUserIds = \App\Models\Follow::where('follower', $user->user_id)
                                ->pluck('following');
    
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

    public function showForumsPage()
    {
        // $forums = DB::table('tblforums')
        // ->leftJoin('forum_members', 'tblforums.forum_id', '=', 'forum_members.forum_id')
        // ->select('tblforums.*', DB::raw('COUNT(forum_members.user_id) as members'))
        // ->groupBy('tblforums.forum_id')
        // ->orderBy('created_at', 'desc')
        
        $forums = DB::table('tblforums')->orderBy('created_at', 'desc')
        ->get();
        
        return view('users.forums', compact('forums'));
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

    public function profilePageFunctions($user){
        $following = Follow::where('follower', $user->user_id)->with('followedUser')->get();
        $followers = Follow::where('following', $user->user_id)->with('followerUser')->get();

        $followingCount = Follow::where('follower', $user->user_id)->count();
        $followerCount = Follow::where('following', $user->user_id)->count();
        

        $posts = Posts::where('postedBy', $user->user_id)
            ->withCount('likes', 'comments', 'bookmarks')
            ->where('status', 'Approved')
            ->orderBy('created_at', 'desc')
            ->get();

        $allPosts = Posts::with('user', 'comments', 'comments.user', 'comments.reply.user')
            ->withCount('likes', 'comments', 'bookmarks')
            ->orderBy('created_at', 'desc')
            ->get();

        $comments = Comment::where('user_id', $user->user_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $likes = DB::table('tbllikes')
            ->join('tblposts', 'tbllikes.post_id', '=', 'tblposts.post_id')
            ->join('tblaccounts', 'tblposts.postedBy', '=', 'tblaccounts.user_id')
            ->where('tbllikes.user_id', $user->user_id)
            ->orderBy('tbllikes.created_at', 'desc')
            ->select('tblposts.*', 
                'tblaccounts.firstName', 
                'tblaccounts.lastName', 
                'tblaccounts.username', 
                'tblaccounts.accountType', 
                'tblaccounts.userPhoto') 
            ->get();

        $bookmarks = DB::table('tblbookmarks')
            ->join('tblposts', 'tblbookmarks.post_id', '=', 'tblposts.post_id')
            ->join('tblaccounts', 'tblposts.postedBy', '=', 'tblaccounts.user_id') // Join with tblaccounts to get user info
            ->where('tblbookmarks.user_id', $user->user_id)
            ->orderBy('tblbookmarks.created_at', 'desc')
            ->select('tblposts.*',
                'tblaccounts.firstName', 
                'tblaccounts.lastName', 
                'tblaccounts.username', 
                'tblaccounts.accountType', 
                'tblaccounts.userPhoto') 
            ->get();
        
        return compact('posts', 'allPosts', 'comments', 'likes', 'bookmarks', 'following', 'followers','followingCount', 'followerCount');
    }
    public function showProfilePage()
    {
        $user = Auth::user();

        $profileFunctions = $this->profilePageFunctions($user);

        return view('users.profile', array_merge(['user' => $user], $profileFunctions));
    }
    
    public function showVisitProfilePage($user_id)
    {
        $user = UserAccount::where('user_id', $user_id)->firstOrFail();

        $profileFunctions = $this->profilePageFunctions($user);

        $isFollowing = \App\Models\Follow::where('follower', $user->user_id)
                        ->where('following', $user->user_id)
                        ->exists();

        return view('users.visit_profile', array_merge(['user' => $user], $profileFunctions), compact('isFollowing'));
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
