<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookTwoLaws;

class AboutLawController extends Controller
{
    // Function to show all articles
    public function showArticlePage()
    {
        // Get all articles and paginate them
        $articles = BookTwoLaws::orderBy('id')->paginate(10);

        // Return the view with the articles data
        return view('moderator.about_law', compact('articles'));
    }

    // Function to search articles based on a query
    public function searchArticlePage(Request $request)
    {
        $query = BookTwoLaws::query();

        $searchTerm = $request->input('search');

        // Check if there's a search term in the request
        if ($request->filled('search')) {
            // Search in multiple fields: concern, postedBy, tags, status
            $query
                ->where('title_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('article_no', 'like', '%' . $searchTerm . '%')
                ->orWhere('article_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('description', 'like', '%' . $searchTerm . '%');
        }

        $articles = $query->paginate(10);

        $noResultsMessage = $articles->isEmpty()
            ? 'No laws found for your search query.'
            : null;

        return view(
            'moderator.about_law',
            compact('articles', 'searchTerm', 'noResultsMessage')
        );
    }
    public function addLaw(Request $request)
    {
        // Validate the request
        $request->validate([
            'title' => 'required|string|max:255',
            'article_no' => 'required|string|max:255',
            'title_name' => 'required|string|max:255',
            'chapter_number' => 'required|string|max:255',
            'chapter_name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'section_name' => 'required|string|max:255',
            'article_name' => 'required|string|max:255',
            'description' => 'required|string',
            'synonyms' => 'required|string',
        ]);

        // Create a new law entry in the database
        BookTwoLaws::create([
            'title' => $request->title,
            'article_no' => $request->article_no,
            'title_name' => $request->title_name,
            'chapter_number' => $request->chapter_number,
            'chapter_name' => $request->chapter_name,
            'section' => $request->section,
            'section_name' => $request->section_name,
            'article_name' => $request->article_name,
            'description' => $request->description,
            'synonyms' => $request->synonyms,
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Law added successfully!');
    }
    public function updateLaw(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'article_no' => 'required|numeric',
            'title_name' => 'required|string|max:255',
            'chapter_number' => 'required|numeric',
            'chapter_name' => 'required|string|max:255',
            'section' => 'required|numeric',
            'section_name' => 'required|string|max:255',
            'article_name' => 'required|string|max:255',
            'description' => 'required|string',
            'synonyms' => 'required|string',
        ]);

        // Find the law by ID and update it
        $law = BookTwoLaws::findOrFail($id);
        $law->update($request->all());

        return redirect()->back()->with('success', 'Law updated successfully.');
    }
    public function deleteLaw($id)
    {
        // Find the law by ID and delete it
        $law = BookTwoLaws::findOrFail($id);
        $law->delete();

        return redirect()->back()->with('success', 'Law deleted successfully.');
    }
}
