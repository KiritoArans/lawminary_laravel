<?php

namespace App\Http\Controllers;

use App\Models\Forums;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    // List all forums
    public function index()
    {
        $forums = Forums::all();
        return view('admin.forums', compact('forums'));
    }

    // Store a new forum
    public function store(Request $request)
    {
        $validated = $request->validate([
            'forum_name' => 'required|string|max:255',
            'forum_desc' => 'required|string',
            'mem_count' => 'required|integer',
        ]);

        Forums::create($validated);

        return redirect()
            ->route('admin.forums')
            ->with('success', 'Forum created successfully!');
    }

    // Update a forum
    // ForumController.php
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'forum_name' => 'required|string|max:255',
            'forum_desc' => 'required|string|max:500',
            'mem_count' => 'required|integer',
        ]);

        // Find the forum by ID and update its details
        $forum = Forums::findOrFail($id);
        $forum->forum_name = $validated['forum_name'];
        $forum->forum_desc = $validated['forum_desc'];
        $forum->mem_count = $validated['mem_count'];

        // Save the updated forum
        $forum->save();

        // Redirect back with success message
        return redirect()
            ->route('admin.forums')
            ->with('success', 'Forum updated successfully!');
    }

    // Delete a forum
    public function destroy($id)
    {
        $forum = Forums::findOrFail($id);
        $forum->delete();

        return redirect()
            ->route('admin.forums')
            ->with('success', 'Forum deleted successfully!');
    }
    //add a forum

    public function add(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'forum_name' => 'required|string|max:255',
            'forum_desc' => 'required|string|max:255',
            'mem_count' => 'required|integer',
        ]);

        // Insert the new forum into the database
        Forums::create($validated);

        // Redirect back to the forums page with a success message
        return redirect()
            ->route('admin.forums')
            ->with('success', 'Forum added successfully!');
    }
    public function search(Request $request)
    {
        $search = $request->input('search'); // Capture the search query

        if ($search) {
            // Filter forums based on the search query (forum name or description)
            $forums = Forums::where('forum_name', 'LIKE', '%' . $search . '%')
                ->orWhere('forum_desc', 'LIKE', '%' . $search . '%')
                ->get();
        } else {
            // If no search term, show all forums
            $forums = Forums::all();
        }

        return view('admin.forums', compact('forums'));
    }
    //filter function
    public function filter(Request $request)
    {
        $query = Forums::query();

        // Filter by members count
        if ($request->input('members')) {
            $members = $request->input('members');
            if ($members == '1-10') {
                $query
                    ->where('mem_count', '>=', 1)
                    ->where('mem_count', '<=', 10);
            } elseif ($members == '11-50') {
                $query
                    ->where('mem_count', '>=', 11)
                    ->where('mem_count', '<=', 50);
            } elseif ($members == '51-100') {
                $query
                    ->where('mem_count', '>=', 51)
                    ->where('mem_count', '<=', 100);
            } elseif ($members == '101') {
                $query->where('mem_count', '>', 100);
            }
        }

        // Filter by date created
        if ($request->input('date_created')) {
            $query->whereDate(
                'created_at',
                '=',
                $request->input('date_created')
            );
        }

        // Get the filtered results
        $forums = $query->get();

        // Return view with filtered results
        return view('admin.forums', compact('forums'));
    }
}
