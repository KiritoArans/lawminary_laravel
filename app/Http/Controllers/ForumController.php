<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\JoinForum;
use App\Models\ForumPosts;
use App\Models\Points;
use App\Models\Like;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ForumController extends Controller
{
    public function showMforums(Request $request)
    {
        $search = $request->input('search'); // Capture the search query

        // Start the query for forums
        $forumsQuery = DB::table('tblforums')

            ->leftJoin(
                'tblforummembers',
                'tblforums.forum_id',
                '=',
                'tblforummembers.forum_id'
            )
            ->select(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumDesc',
                'tblforums.created_at',
                'tblforums.forumPhoto',
                DB::raw('COUNT(tblforummembers.forum_id) as membersCount')
            )
            ->groupBy(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumDesc',
                'tblforums.created_at',
                'tblforums.forumPhoto'
            )
            ->orderBy('tblforums.created_at', 'desc');

        // Apply search filter if search query is present
        if ($search) {
            $forumsQuery
                ->where('tblforums.forumName', 'LIKE', '%' . $search . '%')
                ->orWhere('tblforums.forumDesc', 'LIKE', '%' . $search . '%');
        }

        // Paginate the result (10 records per page)
        $forums = $forumsQuery->paginate(10);

        // Return the appropriate view based on user role
        if (request()->is('admin*')) {
            return view('admin.forums', compact('forums'));
        } elseif (request()->is('moderator*')) {
            return view('moderator.mforums', compact('forums'));
        }

        return redirect()->back()->with('error', 'Unauthorized access.');
    }

    public function searchMforums(Request $request)
    {
        $searchTerm = $request->input('query');

        // Update to use paginate instead of get
        $forums = Forum::with('user')
            ->leftJoin(
                'tblforummembers',
                'tblforums.forum_id',
                '=',
                'tblforummembers.forum_id'
            )
            ->select(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumDesc',
                'tblforums.created_at',
                'tblforums.forumPhoto',
                DB::raw('COUNT(tblforummembers.forum_id) as membersCount')
            )
            ->where('tblforums.forumName', 'LIKE', "%{$searchTerm}%")
            ->orWhere('tblforums.forumDesc', 'LIKE', "%{$searchTerm}%")
            ->orWhere('tblforums.forum_id', 'LIKE', "%{$searchTerm}%")
            ->groupBy(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumDesc',
                'tblforums.created_at',
                'tblforums.forumPhoto'
            )
            ->orderBy('tblforums.created_at', 'desc')
            ->paginate(10); // Paginate with 10 records per page

        // Pass the search term along with pagination links
        $forums->appends(['query' => $searchTerm]);

        if (request()->is('admin*')) {
            return view('admin.forums', compact('forums'));
        } elseif (request()->is('moderator*')) {
            return view('moderator.mforums', compact('forums'));
        }

        return redirect()->back()->with('error', 'Unauthorized access.');
    }

    public function filterMforums(Request $request)
    {
        // Retrieve filter inputs
        $forumId = $request->input('filterForumId');
        $forumName = $request->input('filterForumName');
        $forumDesc = $request->input('filterForumDescription');
        $membersCount = $request->input('filterMembersCount');
        $dateCreated = $request->input('filterDateCreated');

        // Build query
        $query = Forum::with('user')
            ->leftJoin(
                'tblforummembers',
                'tblforums.forum_id',
                '=',
                'tblforummembers.forum_id'
            )
            ->select(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumDesc',
                'tblforums.created_at',
                'tblforums.forumPhoto',
                DB::raw('COUNT(tblforummembers.forum_id) as membersCount')
            )
            ->groupBy(
                'tblforums.forum_id',
                'tblforums.forumName',
                'tblforums.forumDesc',
                'tblforums.created_at',
                'tblforums.forumPhoto'
            );

        // Apply filters conditionally
        if ($forumId) {
            $query->where('tblforums.forum_id', 'LIKE', "%{$forumId}%");
        }

        if ($forumName) {
            $query->where('tblforums.forumName', 'LIKE', "%{$forumName}%");
        }

        if ($forumDesc) {
            $query->where('tblforums.forumDesc', 'LIKE', "%{$forumDesc}%");
        }

        if ($membersCount) {
            $query->having('membersCount', '>=', $membersCount);
        }

        if ($dateCreated) {
            $query->whereDate('tblforums.created_at', $dateCreated);
        }

        // Paginate results
        $forums = $query->orderBy('tblforums.created_at', 'desc')->paginate(10);

        // Append filters to pagination links
        $forums->appends([
            'filterForumId' => $forumId,
            'filterForumName' => $forumName,
            'filterForumDescription' => $forumDesc,
            'filterMembersCount' => $membersCount,
            'filterDateCreated' => $dateCreated,
        ]);

        if (request()->is('admin*')) {
            return view('admin.forums', compact('forums'));
        } elseif (request()->is('moderator*')) {
            return view('moderator.mforums', compact('forums'));
        }

        return redirect()->back()->with('error', 'Unauthorized access.');
    }

    public function getForumDetails($forum_id)
    {
        // Find the forum by its forum_id instead of id
        $forum = Forum::where('forum_id', $forum_id)->first();

        // Check if the forum exists
        if ($forum) {
            return response()->json($forum);
        } else {
            return response()->json(['error' => 'Forum not found'], 404);
        }
    }

    // Store a new forum
    public function createForum(Request $request)
    {
        $validated = $request->validate([
            'forumName' => 'required|string|max:50',
            'forumPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'forumDesc' => 'required|string|max:150',
        ]);

        $forum = new Forum();

        $forum->forum_id = uniqid('forum_');
        $forum->forumName = $request['forumName'];
        $forum->forumDesc = $request['forumDesc'];

        if ($request->hasFile('forumPhoto')) {
            $photoPath = $request
                ->file('forumPhoto')
                ->store('public/files/forums');
            $forum->forumPhoto = $photoPath;
        }

        $forum->save();

        \Log::info('Request Method:', ['method' => $request->method()]);

        if ($request->is('admin/*')) {
            return redirect()
                ->route('admin.forums')
                ->with('success', 'Forum created successfully!');
        } elseif ($request->is('moderator/*')) {
            return redirect()
                ->route('moderator.mforums')
                ->with('success', 'Forum created successfully!');
        }
    }

    // public function createPost(Request $request)
    // {
    //     $data = $request->validate([
    //         'forum_id' => 'required',
    //         'concern' => 'required|string|max:255',
    //         'concernPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif',
    //     ]);

    //     $activeForum = session('activeForum');

    //     $post = new ForumPosts();

    //     $post->forum_id = $data['forum_id'];
    //     $post->post_id = uniqid();
    //     $post->concern = $data['concern'];
    //     $post->postedBy = Auth::user()->user_id;

    //     if ($request->hasFile('concernPhoto')) {
    //         $photoPath = $request
    //             ->file('concernPhoto')
    //             ->store('public/files/forum_posts');
    //         $post->concernPhoto = $photoPath;
    //     }

    //     $post->save();

    //     return redirect()->back()->with('success', 'Posted successfully.');
    // }

    public function joinForum(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'forum_id' => 'required',
        ]);

        $joined = JoinForum::where('user_id', $user->user_id)
            ->where('forum_id', $data['forum_id'])
            ->first();

        if ($joined) {
            $joined->delete();
            return redirect()->back()->with('success', 'You left the forum.');
        }

        $join = new JoinForum();
        $join->forum_id = $data['forum_id'];
        $join->user_id = $user->user_id;
        $join->save();

        return redirect()
            ->back()
            ->with('success', 'You have joined the forum.');
    }

    //edit forums

    public function updateForum(Request $request, $forum_id)
    {
        $validated = $request->validate([
            'forumName' => 'required|string|max:50',
            'forumDesc' => 'required|string|max:150',
            'dateCreated' => 'required|date',
            'forumPhoto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the image file
        ]);

        $forum = Forum::where('forum_id', $forum_id)->firstOrFail();
        $forum->forumName = $validated['forumName'];
        $forum->forumDesc = $validated['forumDesc'];
        $forum->created_at = $validated['dateCreated'];
        // Handle photo upload if a new photo is uploaded
        if ($request->hasFile('forumPhoto')) {
            // Delete the old photo if it exists
            if ($forum->forumPhoto) {
                Storage::delete($forum->forumPhoto);
            }

            // Save the new photo
            $photoPath = $request
                ->file('forumPhoto')
                ->store('public/files/forums');
            $forum->forumPhoto = $photoPath;
        }

        $forum->save();

        if ($request->is('admin/*')) {
            return redirect()
                ->route('admin.forums')
                ->with('success', 'Forum updated successfully!');
        } elseif ($request->is('moderator/*')) {
            return redirect()
                ->route('moderator.mforums')
                ->with('success', 'Forum updated successfully!');
        }
    }

    public function deleteForum($forum_id)
    {
        // Find the forum by its forum_id
        $forum = Forum::where('forum_id', $forum_id)->firstOrFail();

        // Delete the forum
        $forum->delete();

        // Redirect back with a success message
        return redirect()
            ->back()
            ->with('success', 'Forum deleted successfully!');
    }
}
