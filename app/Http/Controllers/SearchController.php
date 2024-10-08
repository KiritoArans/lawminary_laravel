<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\UserAccount;

class SearchController extends Controller
{

    public function searchPostUser(Request $request)
    {
        $query = $request->input('query');
    
        $users = UserAccount::whereIn('accountType', ['User', 'Lawyer']) 
            ->withCount([
                'posts' => function ($query) {
                    $query->where('status', 'Approved'); 
                },
                'followers' 
            ])
            ->get()
            ->filter(function ($user) use ($query) {
                $firstNameDistance = levenshtein(strtolower($query), strtolower($user->firstName));
                $lastNameDistance = levenshtein(strtolower($query), strtolower($user->lastName));
                $usernameDistance = levenshtein(strtolower($query), strtolower($user->username));
                
                // Allow close matches (distance less than or equal to 3, adjust as needed)
                return $firstNameDistance <= 3 || $lastNameDistance <= 3 || $usernameDistance <= 3;
            });
    
        $posts = Posts::where('status', 'Approved') 
            ->with('user') 
            ->withCount('likes', 'comments', 'bookmarks') 
            ->get()
            ->filter(function ($post) use ($query) {
                $concernDistance = levenshtein(strtolower($query), strtolower($post->concern));
                $firstNameDistance = levenshtein(strtolower($query), strtolower($post->user->firstName));
                $lastNameDistance = levenshtein(strtolower($query), strtolower($post->user->lastName));
                $usernameDistance = levenshtein(strtolower($query), strtolower($post->user->username));
    
                // Allow close matches (distance less than or equal to 3, adjust as needed)
                return $concernDistance <= 3 || $firstNameDistance <= 3 || $lastNameDistance <= 3 || $usernameDistance <= 3;
            });
    
        $allPosts = Posts::with(
            'user',
            'comments',
            'comments.user',
            'comments.reply.user'
        )
        ->withCount('likes', 'comments', 'bookmarks')
        ->orderBy('created_at', 'desc')
        ->get();
    
        // Return the search results to the view
        return view('users.home-search', compact('users', 'posts', 'query', 'allPosts'));
    }
    
    
}
