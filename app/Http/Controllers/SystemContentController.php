<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
    {
        // Validate request fields for adding new data
        $request->validate([
            'system_name' => 'nullable|string',
            'system_desc' => 'nullable|string',
            'system_desc2' => 'nullable|string',
            'partner_name' => 'nullable|string',
            'partner_desc' => 'nullable|string',
            'partner_desc2' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        // Create a new instance of SystemContent and set fields
        $syscon = new SystemContent();
        $syscon->system_name = $request->input('system_name');
        $syscon->system_desc = $request->input('system_desc');
        $syscon->system_desc2 = $request->input('system_desc2');
        $syscon->partner_name = $request->input('partner_name');
        $syscon->partner_desc = $request->input('partner_desc');
        $syscon->partner_desc2 = $request->input('partner_desc2');

        // Handle file upload for logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('imgs', 'public');
            $syscon->logo_path = $logoPath;
        }

        $syscon->save();

        return redirect()
            ->back()
            ->with('success', 'Resource added successfully!');
    }

    public function update(Request $request, $id)
    {
        // Find the SystemContent record by ID
        $syscon = SystemContent::findOrFail($id);

        // Determine which field to update based on the 'field' input
        $field = $request->input('field');

        // Validate fields based on the specified field being updated
        $validationRules = [];
        switch ($field) {
            case 'system_name':
                $validationRules = [
                    'system_name' => 'required|string',
                    'system_desc' => 'nullable|string',
                    'system_desc2' => 'nullable|string',
                ];
                break;

            case 'partner_name':
                $validationRules = [
                    'partner_name' => 'required|string',
                    'partner_desc' => 'nullable|string',
                    'partner_desc2' => 'nullable|string',
                ];
                break;

            case 'logo':
                $validationRules = [
                    'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                ];
                break;
        }
        $request->validate($validationRules);

        // Update fields based on 'field' input
        if ($field === 'system_name') {
            $syscon->system_name = $request->input('system_name');
            $syscon->system_desc = $request->input('system_desc');
            $syscon->system_desc2 = $request->input('system_desc2');
        } elseif ($field === 'partner_name') {
            $syscon->partner_name = $request->input('partner_name');
            $syscon->partner_desc = $request->input('partner_desc');
            $syscon->partner_desc2 = $request->input('partner_desc2');
        } elseif ($field === 'logo') {
            if ($request->hasFile('logo')) {
                if ($syscon->logo_path) {
                    Storage::disk('public')->delete($syscon->logo_path);
                }
                $logoPath = $request->file('logo')->store('imgs', 'public');
                $syscon->logo_path = $logoPath;
            }
        }

        // Set the updated_by field and save
        $syscon->updated_by = Auth::id();
        $syscon->save();

        return redirect()
            ->back()
            ->with(
                'success',
                ucfirst(str_replace('_', ' ', $field)) .
                    ' updated successfully!'
            );
    }
}
