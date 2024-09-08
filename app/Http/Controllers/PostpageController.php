<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        // If it's a GET request (normal page load), fetch all posts
        $recentActivities = DB::table('tblposts')
            ->orderBy('updated_at', 'desc')
            ->get();

        // Fetch pending posts for displaying in the modal or list
        $pendingPosts = DB::table('tblposts')
            ->where('status', 'Pending')
            ->get();

        // Return the view with both recent activities and pending posts
        return view('admin.postpage', [
            'recentActivities' => $recentActivities,
            'pendingPosts' => $pendingPosts,
        ]);
    }

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

        // Return the same view with the filtered posts
        return view('admin.postpage', [
            'recentActivities' => $filteredPosts,
            'pendingPosts' => DB::table('tblposts')
                ->where('status', 'Pending')
                ->get(),
        ]);
    }
}
