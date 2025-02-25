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
            'concernCategory' => 'required',
        ]);

        $post = new Posts;

        $post->post_id = uniqid('post_');
        $post->concern = $data['concern'];
        $post->concernCategory = $data['concernCategory'];
        $post->postedBy = Auth::user()->user_id; 
        
        $post->status = "Pending";
        $post->privacy = "Private";

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

    public function updatePrivacy(Request $request, $postId)
    {
        $post = Posts::where('post_id', $postId)->first();

        if (!$post) {
            return response()->json(['success' => false, 'message' => 'Post not found.']);
        }

        // Check if the logged-in user is the one who posted it
        if (Auth::check() && Auth::user()->user_id == $post->postedBy) {
            // Update the post privacy to 'Public'
            $post->update(['privacy' => 'Public']);

            return response()->json(['success' => true, 'message' => 'Post has been published to Public.']);
        }

        return response()->json(['success' => false, 'message' => 'Unauthorized action.']);
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

        $like = Like::where('user_id', $user->user_id)
                    ->where('post_id', $data['post_id'])
                    ->first();

        $isLiked = false; 

        if ($like) {
            $like->delete();
            $isLiked = false; 
        } else {
            $newLike = new Like();
            $newLike->liked_id = uniqid('like_');
            $newLike->post_id = $data['post_id'];
            $newLike->user_id = $user->user_id;
            $newLike->like = 1;
            $newLike->save();

            $post = Posts::where('post_id', $data['post_id'])->with('user')->first();

            if ($post) {
                if ($post->user->user_id !== $user->user_id) {
                    $post->user->notify(new PostLiked($user, $post));
                }

                if ($post->user->accountType === 'Lawyer') {
                    $addPoints = new Points();
                    $addPoints->lawyerUser_id = $post->user->user_id; 
                    $addPoints->points = "15";
                    $addPoints->pointsFrom = "Like"; 
                    $addPoints->save();
                }
            }

            $isLiked = true;
        }

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
    
        $isBookmarked = false;
    
        if ($bookmark) {
            $bookmark->delete();
            $isBookmarked = false; 
        } else {
            // Create a new bookmark
            $newBookmark = new Bookmark();
            $newBookmark->post_id = $data['post_id'];
            $newBookmark->user_id = $user->user_id;
            $newBookmark->bookmark = 1;
            $newBookmark->save();
    
            $isBookmarked = true; 
    
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