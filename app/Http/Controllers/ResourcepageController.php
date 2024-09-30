<?php

namespace App\Http\Controllers;

use App\Models\ResourceFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResourcepageController extends Controller
{
    public function resources()
    {
        // Fetch all resources from the database
        $resources = ResourceFile::orderBy('created_at', 'desc')->paginate(10);

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

    public function updateResource(Request $request)
    {
        // Validate the input
        $request->validate([
            'id' => 'required|exists:tblresources,id',
            'documentTitle' => 'required|string|max:255',
            'documentDesc' => 'required|string',
            'documentFile' => 'nullable|file', // Adjust based on your file requirements
        ]);

        // Find the resource by ID
        $resource = ResourceFile::findOrFail($request->id);

        // Update the resource fields
        $resource->documentTitle = $request->input('documentTitle');
        $resource->documentDesc = $request->input('documentDesc');

        // If a file is uploaded, handle the file update
        if ($request->hasFile('documentFile')) {
            \Log::info(
                'Uploaded file MIME type: ' .
                    $request->file('documentFile')->getMimeType()
            );
            $filePath = $request
                ->file('documentFile')
                ->store('resource', 'private');
            $resource->documentFile = $filePath;
        }

        // Save the updated resource
        $resource->save();

        // Redirect back or to another page with success message
        return redirect()
            ->back()
            ->with('success', 'Resource updated successfully!');
    }

    //delete function

    public function destroy($id)
    {
        $resource = ResourceFile::find($id);

        if ($resource) {
            // Optionally delete the file from the storage if needed
            // Storage::delete($resource->documentFile);

            $resource->delete(); // Delete the resource from the database
            return redirect()
                ->back()
                ->with('success', 'Resource deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Resource not found.');
        }
    }

    //add function:
    public function uploadResource(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'documentTitle' => 'required|string|max:255',
            'documentDesc' => 'required|string',
            'documentFile' => 'required|file|mimes:pdf,doc,docx,jpg,png,zip', // Adjust the max size based on your needs
        ]);

        // Store the uploaded file in the 'resources' directory inside the public storage
        $filePath = $request
            ->file('documentFile')
            ->store('resources', 'private');

        // Create a new resource entry in the database
        $resource = new ResourceFile(); // Adjust this according to your model
        $resource->documentTitle = $request->input('documentTitle');
        $resource->documentDesc = $request->input('documentDesc');
        $resource->documentFile = $filePath;
        $resource->save();

        // Redirect with a success message
        return redirect()
            ->back()
            ->with('success', 'Resource uploaded successfully!');
    }
    //search function

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        // Search resources based on title or description
        $resources = ResourceFile::where(
            'documentTitle',
            'like',
            '%' . $searchQuery . '%'
        )
            ->orWhere('documentDesc', 'like', '%' . $searchQuery . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Pass the search query and results to the view
        return view('moderator.resources', compact('resources'))->with(
            'searchQuery',
            $searchQuery
        );
    }

    public function downloadResource($id)
    {
        // Fetch the resource by ID
        $resource = ResourceFile::findOrFail($id);

        // Temporarily remove the authorization check for testing
        // if (!Auth::user()->can('download', $resource)) {
        //     abort(403, 'Unauthorized action.');
        // }

        // The file path is stored in the database, so we fetch it
        $filePath = $resource->documentFile; // This contains the path inside 'storage/app/private/resources'

        // Return the file as a download
        return Storage::disk('private')->download($filePath);
    }

    //user side table
    public function showUserResources(Request $request)
    {
        // Fetch search query if it exists
        $search = $request->query('search');

        // Fetch resources based on search query
        $resources = ResourceFile::when($search, function ($query, $search) {
            return $query
                ->where('documentTitle', 'like', "%{$search}%")
                ->orWhere('documentDesc', 'like', "%{$search}%");
        })
            ->select(
                'id',
                'documentTitle as title',
                'documentDesc as description',
                'documentFile as file'
            ) // Only select necessary fields
            ->paginate(10); // Pagination with 10 items per page

        // Return the view with resources for users
        return view('users.resources', compact('resources'));
    }
}
