<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Like;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $data = $request->validate([
            'concern' => 'required|string|max:255',
            'concernPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif', 
        ]);

        $post = new Posts;

        $post->post_id = uniqid();
        $post->concern = $data['concern'];
        $post->postedBy = Auth::user()->user_id; 

        if ($request->hasFile('concernPhoto')) {
            $photoPath = $request->file('concernPhoto')->store('public/files/posts');
            $post->concernPhoto = $photoPath;
        }

        $post->save();

        $PageController = new PageController();

        return redirect()->back()->with('success', 'Your concern has been posted!');
    }

    public function likePost(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'post_id' => 'required|exists:tblposts,post_id',
        ]);
    
        $like = Like::where('user_id', $user->user_id)
                    ->where('post_id', $data['post_id'])
                    ->first();
    
        if ($like) {
            $like->delete();
            return redirect()->back()->with('success', 'Post unliked.');
        }
    
        $newLike = new Like();
        $newLike->liked_id = uniqid();
        $newLike->post_id = $data['post_id'];
        $newLike->user_id = $user->user_id;
        $newLike->like = 1;
        $newLike->save();
    
        return redirect()->back()->with('success', 'Post liked!');
    }

    public function bookmarkPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'post_id' => 'required|exists:tblposts,post_id',
        ]);
    
        $bookmark = Bookmark::where('user_id', $user->user_id)
                    ->where('post_id', $data['post_id'])
                    ->first();
    
        if ($bookmark) {
            $bookmark->delete();
            return redirect()->back()->with('success', 'Post unbookmarked.');
        }
    
        $newBookmark = new Bookmark();
        $newBookmark->post_id = $data['post_id'];
        $newBookmark->user_id = $user->user_id;
        $newBookmark->bookmark = 1;
        $newBookmark->save();
    
        return redirect()->back()->with('success', 'Post bookmarked!');
    }
}
