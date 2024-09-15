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
}
