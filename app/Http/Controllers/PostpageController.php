<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Posts;
use App\Models\UserAccount;
use App\Models\Report;
use App\Notifications\PostApproved;

class PostpageController extends Controller
{
    public function postpage(Request $request)
    {
        // Handle form submission (POST request for approve/disregard)
        if ($request->isMethod('post')) {
            $postId = $request->input('post_id');

            // Ensure the post ID exists
            $username = auth()->user()->username;

            $post = DB::table('tblposts')->where('post_id', $postId)->first();

            // BOYYY, IF WALANG PROBLEM ANG PAG AAPPROVE SAYO PWEDE NA IDELETE TONG MGA TO

            // if (!$post) {
            //     return redirect()->back()->with('error', 'Post not found.');
            // }

            // if ($request->has('approve')) {
            //     // Approve the post
            //     $updated = DB::table('tblposts')
            //         ->where('post_id', $postId)
            //         ->update([
            //             'status' => 'Approved',
            //             'approvedBy' => $username,
            //         ]);

            //     // Check if the update was successful
            //     if ($updated) {
            //         return redirect()
            //             ->back()
            //             ->with('success', 'Post approved successfully.');
            //     } else {
            //         return redirect()
            //             ->back()
            //             ->with('error', 'Failed to approve post.');
            //     }
            // }

            // UNTIL HERE LANG, PAG NAG DELETE KA NG SOBRA, IKAW IDEDELETE KO SA MOANTHO

            if (!$post) {
                return redirect()->back()->with('error', 'Post not found.');
            } elseif (!$post->concernCategory) {
                return redirect()
                    ->back()
                    ->with('error', 'Post is missing a category.');
            }

            if ($request->has('approve')) {
                // Proceed with approval if all checks pass
                $updated = DB::table('tblposts')
                    ->where('post_id', $postId)
                    ->update([
                        'status' => 'Approved',
                        'approvedBy' => $username,
                    ]);

                if ($updated) {
                    // Find lawyers with matching field expertise and notify them
                    $lawyers = UserAccount::where('accountType', 'Lawyer')
                        ->where('fieldExpertise', $post->concernCategory)
                        ->get();

                    foreach ($lawyers as $lawyer) {
                        $lawyer->notify(
                            new PostApproved($post, auth()->user())
                        );
                    }

                    return redirect()
                        ->back()
                        ->with(
                            'success',
                            'Post approved and relevant lawyers notified.'
                        );
                } else {
                    return redirect()
                        ->back()
                        ->with('error', 'Failed to approve post.');
                }
            }

            // DIVIDER LANG, PARA ALAM KO BOUNDARY KO DI GAYA NG BOYBESPREN NG JOWA MO :P >_<
            elseif ($request->has('reject')) {
                // Validate reason for disregard
                $request->validate([
                    'reasonDisregard' => 'required|string|max:500',
                ]);

                $reasonDisregard = $request->input('reasonDisregard');

                // Disregard the post with reason
                $updated = DB::table('tblposts')
                    ->where('post_id', $postId)
                    ->update([
                        'status' => 'Disregarded',
                        'approvedBy' => $username,
                        'reasonDisregard' => $reasonDisregard,
                    ]);

                \Log::info('Update Status:', ['updated' => $updated]);

                // Check if the update was successful
                if ($updated) {
                    return redirect()
                        ->back()
                        ->with('success', 'Post disregarded successfully.');
                } else {
                    return redirect()
                        ->back()
                        ->with('error', 'Failed to disregard post.');
                }
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
        $query = Posts::with('user')->orderBy('updated_at', 'desc');

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

        if ($request->filled('filterConcernCategory')) {
            $query->where(
                'concernCategory',
                'like',
                '%' . $request->input('filterConcernCategory') . '%'
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
                ->orWhere('status', 'like', '%' . $searchTerm . '%')
                ->orWhere('concernCategory', 'like', '%' . $searchTerm . '%');
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
        $username = auth()->user()->username;

        // Validate the input data
        $request->validate([
            'concern' => 'required|string|max:255',
            'concernCategory' => 'required|string|max:255',
            'status' => 'required|in:Pending,Approved,Disregarded',
            'tags' => 'nullable|string|max:255',
            'postedBy' => 'required|string|max:255',
            'approvedBy' => 'nullable|string|max:255',
        ]);

        // Update the post
        $post->concern = $request->concern;
        $post->concernCategory = $request->concernCategory;
        $post->status = $request->status;
        $post->tags = $request->tags;
        $post->postedBy = $request->postedBy;
        $post->approvedBy = $username;
        $post->save();

        if ($request->is('admin/*')) {
            return redirect()
                ->route('admin.postpage')
                ->with('success', 'Post updated successfully');
        } elseif ($request->is('moderator/*')) {
            return redirect()
                ->route('moderator.postpage')
                ->with('success', 'Post updated successfully');
        }
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

    public function viewReportedPosts()
    {
        // Fetch the reported posts that are not disregarded
        $reportedPosts = DB::table('tblposts')
            ->join('tblreports', 'tblposts.post_id', '=', 'tblreports.post_id') // Join the posts and reports table on post_id
            ->select(
                'tblposts.post_id', // Specify the columns you need
                'tblposts.concern', // Include other necessary columns from tblposts
                DB::raw(
                    'GROUP_CONCAT(tblreports.reportContent SEPARATOR "; ") as reportContents'
                )
            ) // Fetch post details and reports
            ->where('tblposts.status', 'Approved') // Only select posts that are "Approved"
            ->groupBy('tblposts.post_id', 'tblposts.concern') // Group by post_id and any other selected columns
            ->get();

        return response()->json($reportedPosts);
    }

    public function viewPostReports($postId)
    {
        $reports = DB::table('tblreports')
            ->where('post_id', $postId)
            ->select('report_id', 'reportContent')
            ->get();

        return response()->json($reports);
    }

    public function disregardPost($postId)
    {
        $post = Posts::where('post_id', $postId)->first();
        if ($post) {
            $post->status = 'Disregarded'; // Update status to 'Disregarded'
            $post->save();
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
