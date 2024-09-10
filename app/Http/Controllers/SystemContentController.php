<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemContent;

class SystemContentController extends Controller
{
    public function index()
    {
        // Fetch data from tblsyscon
        $sysconData = SystemContent::all();

        // Pass the data to the view
        return view('admin.systemcontent', [
            'sysconData' => $sysconData,
        ]);
    }
    public function edit($id)
    {
        // Fetch the record by its ID
        $syscon = SystemContent::findOrFail($id);

        // Return the edit view with the data
        return view('includes_syscon.syscon_edit_inc', compact('syscon'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required', // Adjust depending on file or string
        ]);

        // Fetch the record by its ID
        $syscon = SystemContent::findOrFail($id);

        // Update the fields
        $syscon->name = $validated['name'];

        if ($request->hasFile('content')) {
            $fileName = $request->file('content')->store('uploads'); // Save the file and store the path
            $syscon->content = $fileName; // Update content field with file path
        } else {
            $syscon->content = $validated['content'];
        }

        // Save the updated record
        $syscon->save();

        // Redirect with success message
        return redirect()
            ->route('admin.systemcontent')
            ->with('success', 'Content updated successfully!');
    }

    //search function

    public function search(Request $request)
    {
        // Get the search query from the request
        $query = $request->input('query');

        // Search the SystemContent model by name or content
        $sysconData = SystemContent::where('name', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get();

        // Return the results to the view
        return view('admin.systemcontent', [
            'sysconData' => $sysconData,
        ]);
    }
}
