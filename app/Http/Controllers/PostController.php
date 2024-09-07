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

    // public function likePost(Request $request)
    // {
    //     $validated = $request->validate([
    //         'post_id' => 'required|exists:tblposts,post_id',
    //         'user_id' => 'required|exists:tblaccounts,user_id',
    //         'like' => 'required|boolean',
    //     ]);

    //     // Check if the user has already liked this post
    //     $existingLike = Like::where('post_id', $validated['post_id'])
    //                         ->where('user_id', $validated['user_id'])
    //                         ->first();

    //     if ($existingLike) {
    //         return response()->json(['success' => false, 'message' => 'You have already liked this post.']);
    //     }

    //     // Create a new like entry
    //     $like = new Like();
    //     $like->post_id = $validated['post_id'];
    //     $like->user_id = $validated['user_id'];
    //     $like->like = $validated['like'];
    //     $like->save();

    //     return response()->json(['success' => true, 'message' => 'Post liked successfully!']);
    // }
}
