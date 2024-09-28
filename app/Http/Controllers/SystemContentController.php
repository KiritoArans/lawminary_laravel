<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SystemContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        \Log::info('Form submitted:', $request->all());
        $syscon = SystemContent::findOrFail($id);

        $request->validate([
            'system_name' => 'nullable|string',
            'about_lawminary' => 'nullable|string',
            'about_pao' => 'nullable|string',
            'terms_of_service' => 'nullable|string',
        ]);

        // Identify which field is being updated based on 'field'
        $field = $request->input('field');

        // Validate and update based on the field being updated
        switch ($field) {
            case 'system_name':
                $request->validate([
                    'system_name' => 'required|string|max:255',
                ]);
                $syscon->system_name = $request->input('system_name');
                break;

            case 'about_lawminary':
                $request->validate(['about_lawminary' => 'required|string']);
                $syscon->about_lawminary = $request->input('about_lawminary');
                break;

            case 'about_pao':
                $request->validate(['about_pao' => 'required|string']);
                $syscon->about_pao = $request->input('about_pao');
                break;

            case 'terms_of_service':
                $request->validate(['terms_of_service' => 'required|string']);
                $syscon->terms_of_service = $request->input('terms_of_service');
                break;

            case 'logo':
                $request->validate([
                    'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif',
                ]);

                // Store the new logo and delete the old one if it exists
                if ($request->hasFile('logo')) {
                    if ($syscon->logo_path) {
                        Storage::disk('public')->delete($syscon->logo_path);
                    }
                    $logoPath = $request->file('logo')->store('imgs', 'public');
                    $syscon->logo_path = $logoPath;
                }
                break;
            default:
                // Log the invalid field for debugging purposes
                Log::info('Incoming Request Data:', $request->all());
        }

        // Update 'updated_by' field with authenticated user's ID
        $syscon->updated_by = Auth::id();

        // Save changes
        $syscon->save();

        return redirect()
            ->back()
            ->with('success', 'Resource updated successfully!');
    }
}
