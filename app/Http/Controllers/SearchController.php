<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\UserAccount;

class SearchController extends Controller
{

    public function searchPostUser(Request $request)
    {
        // Get the search query
        $query = $request->input('query');
    
        // Search users based on their name or username
        $users = UserAccount::where('firstName', 'LIKE', "%$query%")
            ->orWhere('lastName', 'LIKE', "%$query%")
            ->orWhere('username', 'LIKE', "%$query%")
            ->get();
    
        // Search posts based on their content (assuming `concern` is the field where the post content is stored)
        $posts = Posts::where('status', 'Approved') // Filter only Approved posts
            ->where(function($q) use ($query) {
                $q->where('concern', 'LIKE', "%$query%") // Search in post content
                ->orWhereHas('user', function ($q) use ($query) { // Search in user name/username
                    $q->where('firstName', 'LIKE', "%$query%")
                        ->orWhere('lastName', 'LIKE', "%$query%")
                        ->orWhere('username', 'LIKE', "%$query%");
                });
            })
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
    
        // Return the search results to the view
        return view('users.home-search', compact('users', 'posts', 'query', 'allPosts'));
    }
    
}
