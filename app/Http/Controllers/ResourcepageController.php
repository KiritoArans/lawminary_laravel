<?php

namespace App\Http\Controllers;

use App\Models\ResourceFile;
use Illuminate\Http\Request;

class ResourcepageController extends Controller
{
    public function resources()
    {
        // Fetch all resources from the database
        $resources = ResourceFile::paginate(10);

        // Instead of redirecting, return the view with resources
        return view('moderator.resources', compact('resources'));
    }

    public function filterResources(Request $request)
    {
        // Start a query
        $query = ResourceFile::query();

        // Apply filters if provided
        if ($request->filled('filterId')) {
            $query->where('id', $request->input('filterId'));
        }
        if ($request->filled('filterTitle')) {
            $query->where(
                'documentTitle',
                'like',
                '%' . $request->input('filterTitle') . '%'
            );
        }
        if ($request->filled('filterDesc')) {
            $query->where(
                'documentDesc',
                'like',
                '%' . $request->input('filterDesc') . '%'
            );
        }
        if ($request->filled('filterDate')) {
            $query->whereDate('created_at', $request->input('filterDate'));
        }

        // Paginate results
        $resources = $query->paginate(10);

        // Return the view with the filtered results
        return view('moderator.resources', compact('resources'));
    }

    public function updateResource(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'documentTitle' => 'required|string|max:255',
            'documentDesc' => 'required|string',
            'documentFile' =>
                'nullable|mimes:pdf,doc,docx,jpg,png,zip|max:2048',
        ]);

        // Find the resource by ID
        $resource = ResourceFile::findOrFail($id);

        // Update the resource fields
        $resource->documentTitle = $request->input('documentTitle');
        $resource->documentDesc = $request->input('documentDesc');

        // Check if a new file was uploaded and replace the old one
        if ($request->hasFile('documentFile')) {
            $path = $request
                ->file('documentFile')
                ->store('resources', 'public');
            $resource->documentFile = $path;
        }

        // Save the updated resource to the database
        $resource->save();

        // Redirect back with success message
        return redirect()
            ->back()
            ->with('success', 'Resource updated successfully!');
    }
}
