<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\ForumPosts;
use App\Models\Points;
use App\Models\Like;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PageController;
use App\Notifications\PostLiked;
use App\Notifications\PostBookmarked;

class PostController extends Controller
{
    public function createPost(Request $request)
    {
        $data = $request->validate([
            'concern' => 'required|string|max:255',
            'concernPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif', 
        ]);

        $post = new Posts;

        $post->post_id = uniqid('post_');
        $post->concern = $data['concern'];
        $post->postedBy = Auth::user()->user_id; 
        
        $post->status = "Pending";

        if ($request->hasFile('concernPhoto')) {
            $photoPath = $request->file('concernPhoto')->store('public/files/posts');
            $post->concernPhoto = $photoPath;
        }

        $post->save();

        return redirect()->back()->with('success', 'Concern has been sent, please wait for approval.');
    }

    public function createForumPost(Request $request)
    {
        $data = $request->validate([
            'forum_id' => 'required',
            'concern' => 'required|string|max:255',
            'concernPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $activeForum = session('activeForum');

        $post = new ForumPosts();

        $post->forum_id = $data['forum_id'];
        $post->post_id = uniqid('fpost_');
        $post->concern = $data['concern'];
        $post->postedBy = Auth::user()->user_id;

        if ($request->hasFile('concernPhoto')) {
            $photoPath = $request
                ->file('concernPhoto')
                ->store('public/files/forum_posts');
            $post->concernPhoto = $photoPath;
        }

        $post->save();

        return redirect()->back()->with('success', 'Posted successfully.');
    }

    public function deletePost($postId)
    {
        $post = Posts::where('post_id', $postId)->first();
    
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }
    
        if ($post->postedBy != Auth::user()->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }
    
        if ($post->concernPhoto) {
            Storage::delete($post->concernPhoto);
        }
    
        $post->delete();
    
        return redirect()->back()->with('success', 'Post deleted successfully.');
    }
    

    public function deleteForumPost($postId)
    {
        $post = ForumPosts::where('post_id', $postId)->first();

        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        if ($post->postedBy != Auth::user()->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        if ($post->concernPhoto) {
            Storage::delete($post->concernPhoto);
        }

        $post->delete();

        return redirect()->back()->with('success', 'Post deleted successfully.');
    }


    public function likePost(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'post_id' => 'required',
        ]);

        // Check if the like already exists
        $like = Like::where('user_id', $user->user_id)
                    ->where('post_id', $data['post_id'])
                    ->first();

        $isLiked = false; // Track if the post is liked or unliked

        if ($like) {
            // If the like exists, remove it (unlike)
            $like->delete();
            $isLiked = false; // Post unliked
        } else {
            // Otherwise, create a new like entry
            $newLike = new Like();
            $newLike->liked_id = uniqid('like_');
            $newLike->post_id = $data['post_id'];
            $newLike->user_id = $user->user_id;
            $newLike->like = 1;
            $newLike->save();

            // Fetch the post and its user
            $post = Posts::where('post_id', $data['post_id'])->with('user')->first();

            if ($post) {
                // Check if the post author is not the current user
                if ($post->user->user_id !== $user->user_id) {
                    $post->user->notify(new PostLiked($user, $post));
                }

                // If the post's author is a lawyer, add points
                if ($post->user->accountType === 'Lawyer') {
                    $addPoints = new Points();
                    $addPoints->lawyerUser_id = $post->user->user_id; 
                    $addPoints->points = "15";
                    $addPoints->pointsFrom = "Like"; 
                    $addPoints->save();
                }
            }

            $isLiked = true; // Post liked
        }

        // Return the updated like count and whether it was liked/unliked
        $likeCount = Like::where('post_id', $data['post_id'])->count();

        return response()->json([
            'success' => true,
            'message' => $isLiked ? 'Post liked.' : 'Post unliked.',
            'is_liked' => $isLiked,
            'like_count' => $likeCount,
            'post_id' => $data['post_id'],
        ]);
    }

    


    public function bookmarkPost(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'post_id' => 'required',
        ]);
    
        $bookmark = Bookmark::where('user_id', $user->user_id)
                    ->where('post_id', $data['post_id'])
                    ->first();
    
        $isBookmarked = false; // Track if the post is bookmarked or unbookmarked
    
        if ($bookmark) {
            // Post was already bookmarked, so we are unbookmarking it
            $bookmark->delete();
            $isBookmarked = false; // Post unbookmarked
        } else {
            // Create a new bookmark
            $newBookmark = new Bookmark();
            $newBookmark->post_id = $data['post_id'];
            $newBookmark->user_id = $user->user_id;
            $newBookmark->bookmark = 1;
            $newBookmark->save();
    
            $isBookmarked = true; // Post bookmarked
    
            $post = Posts::where('post_id', $data['post_id'])->with('user')->first();
    
            if ($post){
            
                if ($post->user->user_id !== $user->user_id) {
                    $post->user->notify(new PostBookmarked($user, $post));
                }
                
                if ($post->user->accountType === 'Lawyer') {
                    $addPoints = new Points();
                    $addPoints->lawyerUser_id = $post->user->user_id;
                    $addPoints->points = "20";
                    $addPoints->pointsFrom = "Bookmark";
                    $addPoints->save();
                }
            }
        }
    
        // Return the updated bookmark count and whether it was bookmarked/unbookmarked
        $bookmarkCount = Bookmark::where('post_id', $data['post_id'])->count();
    
        return response()->json([
            'success' => true,
            'message' => $isBookmarked ? 'Post bookmarked.' : 'Post unbookmarked.',
            'is_bookmarked' => $isBookmarked,
            'bookmark_count' => $bookmarkCount,
            'post_id' => $data['post_id'],
        ]);
    }
    
}
