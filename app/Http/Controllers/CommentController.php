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
use App\Notifications\CommentRated;

use App\Events\DataUpdated;
use App\Events\CommentCreated;
use App\Events\ReplyCreated;

class CommentController extends Controller
{
    public function createComment(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:255',
            'post_id' => 'required|string|max:100',
        ]);
    
        $user = Auth::user(); // The user who is commenting
        $comment = new Comment();
        $comment->comment_id = uniqid('comm_');
        $comment->user_id = $user->user_id; // The user who commented
        $comment->post_id = $request->post_id;
        $comment->comment = $request->comment;
    
        $comment->save();
    
        // Broadcast the comment
        event(new CommentCreated($comment));
    
        // Notify the post's owner (optional)
        $post = Posts::where('post_id', $request->post_id)->with('user')->first();
        if ($post && $post->user) {
            if ($post->user->user_id !== $user->user_id) {
                $post->user->notify(new PostCommented($user, $post, $comment));
            }
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

        $user = Auth::user();

        // Create the reply
        $reply = new Reply();
        $reply->reply_id = uniqid('rply_');
        $reply->comment_id = $request->input('comment_id');
        $reply->post_id = $request->input('post_id');
        $reply->user_id = $user->user_id;
        $reply->reply = $request->input('reply');
        $reply->save();

        // Broadcast the reply to others
        event(new ReplyCreated($reply));

        $comment = Comment::with('user')->where('comment_id', $request->input('comment_id'))->first();
        if ($comment && $comment->user) {
            if ($comment->user->user_id !== $user->user_id) {
                $comment->user->notify(new PostReplied($user, $comment, $reply));
            }
        }

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

    $user = Auth::user(); // The user who is rating the comment

    // Create a new rating
    $rate = new Rate();
    $rate->user_id = $user->user_id; 
    $rate->comment_id = $request->input('comment_id'); 
    $rate->lawyerUser_id = $request->input('lawyerUser_id');
    $rate->rate = $request->input('rating'); 
    $rate->save();

    // Calculate points based on rating
    $points = $request->input('rating') * 10;

    // Add points to the lawyer's account
    $addPoints = new Points();
    $addPoints->lawyerUser_id = $request->input('lawyerUser_id');
    $addPoints->points = $points; 
    $addPoints->pointsFrom = "Rate";
    $addPoints->save();

    // Fetch the comment and its user (the comment's author)
    $comment = Comment::where('comment_id', $request->input('comment_id'))->with('user')->first();

    if ($comment && $comment->user) {
        if ($comment->user->user_id !== $user->user_id) {
            $comment->user->notify(new CommentRated($user, $comment, $request->input('rating')));
        }
    }

    return response()->json([
        'success' => true,
        'message' => 'Your rating has been submitted.',
        'rating' => $rate->rate,
        'points_awarded' => $points,
        'comment_id' => $request->input('comment_id'),
    ]);
}

}
