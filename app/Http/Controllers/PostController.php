<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
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
        // $post->concernPhoto = $data['concernPhoto'];

        if ($request->hasFile('concernPhoto')) {
            $photoPath = $request->file('concernPhoto')->store('public/files/posts');
            $post->concernPhoto = $photoPath; // Assign the file path to the model's property
        }

        $post->save();


        $PageController = new PageController();

        // return $PageController->showHomePage();

        return redirect()->back()->with('success', 'Your concern has been posted!');
    }
    
    // public function showProfilePosts()
    // {
    //     $user = Auth::user();

    //     $posts = Posts::where('postedBy', $user->user_id)
    //         ->orderBy('created_at', 'desc')
    //         ->get();

    //     return view('users.profile', compact('user', 'posts'));
    //     // return $this->showProfilePage($user, $posts);
    // }
}
