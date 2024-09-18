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

    public function update(Request $request, $id)
    {
        $syscon = SystemContent::findOrFail($id);

        // Identify which field is being updated based on 'field'
        $field = $request->input('field');

        // Handle system_name
        if ($field === 'system_name') {
            $request->validate(['system_name' => 'required|string|max:255']);
            $syscon->system_name = $request->input('system_name');
        }

        // Handle about_lawminary
        elseif ($field === 'about_lawminary') {
            $request->validate(['about_lawminary' => 'required|string']);
            $syscon->about_lawminary = $request->input('about_lawminary');
        }

        // Handle about_pao
        elseif ($field === 'about_pao') {
            $request->validate(['about_pao' => 'required|string']);
            $syscon->about_pao = $request->input('about_pao');
        }

        // Handle terms_of_service
        elseif ($field === 'terms_of_service') {
            $request->validate(['terms_of_service' => 'required|string']);
            $syscon->terms_of_service = $request->input('terms_of_service');
        }

        // Handle logo update
        elseif ($field === 'logo') {
            $request->validate([
                'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Store the new logo and delete the old one if it exists
            if ($request->hasFile('logo')) {
                if ($syscon->logo_path) {
                    Storage::disk('public')->delete($syscon->logo_path);
                }

                $logoPath = $request->file('logo')->store('imgs', 'public');
                $syscon->logo_path = $logoPath;
            }
        }

        // Update 'updated_by' field with authenticated user's ID
        $syscon->updated_by = Auth::id();

        // Save changes
        $syscon->save();

        return redirect()
            ->route('admin.systemcontent')
            ->with('success', 'System content updated successfully!');
    }
}
