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
            ->route('forums.index')
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
}
