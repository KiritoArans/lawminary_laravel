<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;
use App\Models\Posts;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Rate;
use App\Models\Points;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PostCommented;
use App\Notifications\PostReplied;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
            'post_id' => 'required|string|max:100',
        ]);

        $comment = new Comment();
        $comment->comment_id = uniqid('comm_');
        $comment->user_id = Auth::user()->user_id; // The user who commented
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;

        $comment->save();

        // Find the post and the post author (notifying the author)
        $post = Posts::find($request->post_id);
        $postAuthor = $post->user; // Assuming the Post model has a relationship with the User model

        // Notify the post author about the new comment
        if ($postAuthor && $postAuthor->id !== Auth::user()->id) { // Don't notify if the user comments on their own post
            $postAuthor->notify(new PostCommented(Auth::user(), $comment));
        }

        return response()->json([
            'success' => true,
            'message' => 'Your comment has been posted!',
            'new_comment' => [
                'comment' => $comment->comment,
                'user_id' => $comment->user->user_id,
                'user_name' => $comment->user->firstName . ' ' . $comment->user->lastName,
                'user_photo_url' => $comment->user->userPhoto ? Storage::url($comment->user->userPhoto) : asset('imgs/user-img.png')
            ],
        ]);
    }

    // Reply Function
    public function createReply(Request $request)
    {
        $validated = $request->validate([
            'reply' => 'required|string|max:2500',
            'post_id' => 'required|string|max:100',
            'comment_id' => 'required|string|max:100',
        ]);
    
        // Create the reply
        $reply = new Reply();
        $reply->reply_id = uniqid('rply_');
        $reply->comment_id = $request->input('comment_id');
        $reply->post_id = $request->input('post_id');
        $reply->user_id = Auth::user()->user_id;
        $reply->reply = $request->input('reply');
        $reply->save();
    
        $post = Posts::find($request->post_id);
        $postAuthor = $post->user; // Assuming the Post model has a relationship with the User model

        // Notify the post author about the new comment
        if ($postAuthor && $postAuthor->id !== Auth::user()->id) { // Don't notify if the user comments on their own post
            $postAuthor->notify(new PostReplied(Auth::user(), $reply));
        }

        // Find the comment and the comment author
        // $comment = Comment::find($request->comment_id);
        // $commentAuthor = $comment->user; // Assuming the Comment model has a relationship with the User model
    
        // // Notify the comment author about the new reply
        // if ($commentAuthor && $commentAuthor->id !== Auth::user()->id) { // Don't notify if the user replies to their own comment
        //     $commentAuthor->notify(new PostReplied(Auth::user(), $reply));
        // }
    
        return response()->json([
            'success' => true,
            'message' => 'Your reply has been posted!',
            'new_reply' => [
                'reply' => $reply->reply,
                'comment_id' => $reply->comment_id,
                'user_id' => $reply->user->user_id,
                'user_name' => $reply->user->firstName . ' ' . $reply->user->lastName,
                'user_photo_url' => $reply->user->userPhoto ? Storage::url($reply->user->userPhoto) : asset('imgs/user-img.png')
            ],
        ]);
    }
    
    

    public function checkIfRated($comment_id)
    {
        $hasRated = Rate::where('comment_id', $comment_id)
                        ->where('user_id', Auth::user()->user_id)
                        ->exists();
    
        return response()->json(['hasRated' => $hasRated]);
    }
    
    public function rateComment(Request $request)
    {
        $request->validate([
            'lawyerUser_id' => 'required|exists:tblcomments,user_id', 
            'comment_id' => 'required|exists:tblcomments,comment_id', 
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $rate = new Rate();
        $rate->user_id = Auth::user()->user_id; 
        $rate->comment_id = $request->input('comment_id'); 
        $rate->lawyerUser_id = $request->input('lawyerUser_id');
        $rate->rate = $request->input('rating'); 
        $rate->save();


        $points = $request->input('rating') * 10;

        $addPoints = new Points();
        $addPoints->lawyerUser_id = $request->input('lawyerUser_id');
        $addPoints->points = $points; 
        $addPoints->pointsFrom = "Rate";
        $addPoints->save();

        return redirect()->back()->with('success', 'Your rating has been submitted.');
    }

}
