<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\Like;
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
    
        // Check if the user has already liked the post
        $like = Like::where('user_id', $user->user_id)
                    ->where('post_id', $data['post_id'])
                    ->first();

        // $hasLiked = Like::where('user_id', $user->user_id)
        //             ->where('post_id', $like->post_id)
        //             ->exists();

        // return response()->json(['hasLiked' => $hasLiked]);
    
        if ($like) {
            // If already liked, unlike the post by deleting the entry
            $like->delete();
            return redirect()->back()->with('success', 'You unliked the post!');
        }
    
        // Create a new like entry
        $newLike = new Like();
        $newLike->liked_id = uniqid();
        $newLike->post_id = $data['post_id'];
        $newLike->user_id = $user->user_id;
        $newLike->like = 1;
        $newLike->save();
    
        return redirect()->back()->with('success', 'Post liked successfully!');
    }
}
