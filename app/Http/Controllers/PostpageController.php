<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;

class PostpageController extends Controller
{
    public function postpage(Request $request)
    {
        // Handle form submission (POST request for approve/disregard)
        if ($request->isMethod('post')) {
            $postId = $request->input('post_id');
            if ($request->has('approve')) {
                // Approve the post
                DB::table('tblposts')
                    ->where('post_id', $postId)
                    ->update(['status' => 'Approved']);
                return redirect()
                    ->back()
                    ->with('success', 'Post approved successfully.');
            } elseif ($request->has('disregard')) {
                // Disregard the post
                DB::table('tblposts')
                    ->where('post_id', $postId)
                    ->update(['status' => 'Disregarded']);
                return redirect()
                    ->back()
                    ->with('success', 'Post disregarded successfully.');
            }
        }

        $posts = Posts::orderBy('updated_at', 'desc')->paginate(10);

        // Fetch pending posts for displaying in the modal or list
        $pendingPosts = DB::table('tblposts')
            ->where('status', 'Pending')
            ->get();

        // Return the view with both recent activities and pending posts

        if (request()->is('admin*')) {
            return view('admin.postpage', [
                'posts' => $posts,
                'pendingPosts' => $pendingPosts,
            ]);
        } elseif (request()->is('moderator*')) {
            return view('moderator.postpage', [
                'posts' => $posts,
                'pendingPosts' => $pendingPosts,
            ]);
        }
    }

    //filter function

    public function filterPosts(Request $request)
    {
        // Handle GET request (for displaying or filtering posts)
        $query = DB::table('tblposts')->orderBy('updated_at', 'desc');

        // Apply filters based on user input
        if ($request->filled('filterPostId')) {
            $query->where(
                'post_id',
                'like',
                '%' . $request->input('filterPostId') . '%'
            );
        }

        if ($request->filled('filterContent')) {
            $query->where(
                'concern',
                'like',
                '%' . $request->input('filterContent') . '%'
            );
        }

        if ($request->filled('filterStatus')) {
            $query->where(
                'status',
                'like',
                '%' . $request->input('filterStatus') . '%'
            );
        }

        if ($request->filled('filterTags')) {
            $query->where(
                'tags',
                'like',
                '%' . $request->input('filterTags') . '%'
            );
        }

        if ($request->filled('filterPostedBy')) {
            $query->where(
                'postedBy',
                'like',
                '%' . $request->input('filterPostedBy') . '%'
            );
        }

        if ($request->filled('filterApprovedBy')) {
            $query->where(
                'approvedBy',
                'like',
                '%' . $request->input('filterApprovedBy') . '%'
            );
        }

        if ($request->filled('filterDate')) {
            $query->whereDate('updated_at', $request->input('filterDate'));
        }

        // Fetch the filtered posts
        $filteredPosts = $query->get();

        $filteredPosts = $query->paginate(10);

        // Return the same view with the filtered posts
        if (request()->is('admin*')) {
            return view('admin.postpage', [
                'posts' => $filteredPosts,
                'pendingPosts' => DB::table('tblposts')
                    ->where('status', 'Pending')
                    ->get(),
            ]);
        } elseif (request()->is('moderator*')) {
            return view('moderator.postpage', [
                'posts' => $filteredPosts,
                'pendingPosts' => DB::table('tblposts')
                    ->where('status', 'Pending')
                    ->get(),
            ]);
        }
    }

    //search function

    public function searchPosts(Request $request)
    {
        // Start a query for the Posts model
        $query = Posts::query();

        // Check if there's a search term in the request
        if ($request->filled('search')) {
            $searchTerm = $request->input('search');

            // Search in multiple fields: concern, postedBy, tags, status
            $query
                ->where('concern', 'like', '%' . $searchTerm . '%')
                ->orWhere('postedBy', 'like', '%' . $searchTerm . '%')
                ->orWhere('tags', 'like', '%' . $searchTerm . '%')
                ->orWhere('status', 'like', '%' . $searchTerm . '%');
        }

        // Execute the query and get the results
        $posts = $query->get();

        $posts = $query->paginate(10);

        // Return the view with the search results
        if (request()->is('admin*')) {
            return view('admin.postpage', [
                'posts' => $posts, // Pass the results to the view
                'pendingPosts' => Posts::where('status', 'Pending')->get(), // You can keep this for the pending posts
            ]);
        } elseif (request()->is('moderator*')) {
            return view('moderator.postpage', [
                'posts' => $posts, // Pass the results to the view
                'pendingPosts' => Posts::where('status', 'Pending')->get(), // You can keep this for the pending posts
            ]);
        }
    }

    //edit and update function

    // Show the edit form
    public function post_edit_inc($id)
    {
        // Fetch the post based on its ID
        $post = Posts::findOrFail($id);

        // Return the view with the post data
        return view('includes_postpage.post_edit_inc', ['post' => $post]);
    }

    // Handle the form submission and update the post
    public function update(Request $request)
    {
        $post = Posts::find($request->post_id);

        // Validate the input data
        $request->validate([
            'concern' => 'required|string|max:255',
            'status' => 'required|in:pending,approved,disregarded',
            'tags' => 'nullable|string|max:255',
            'postedBy' => 'required|string|max:255',
            'approvedBy' => 'nullable|string|max:255',
        ]);

        // Update the post
        $post->concern = $request->concern;
        $post->status = $request->status;
        $post->tags = $request->tags;
        $post->postedBy = $request->postedBy;
        $post->approvedBy = $request->approvedBy;
        $post->save();

        return redirect()->back()->with('success', 'Post updated successfully');
    }

    // delete function
    public function destroy($id)
    {
        $post = Posts::find($id);

        if ($post) {
            $post->delete();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false], 404); // Return an error if post not found
        }
    }
}
