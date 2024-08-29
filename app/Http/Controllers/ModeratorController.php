<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ResourceFile;
use Illuminate\Support\Facades\DB;

class ModeratorController extends Controller
{
    public function showMaccounts()
    {
        return view('moderator.maccounts');
    }

    public function showMdashboard()
    {
        return view('moderator.mdashboard');
    }

    public function showMfaqs()
    {
        return view('moderator.mfaqs');
    }

    public function showMforums()
    {
        return view('moderator.mforums');
    }

    public function showMleaderboards()
    {
        return view('moderator.mleaderboards');
    }

    public function showMposts()
    {
        return view('moderator.mposts');
    }

    public function showMresources()
    {
        $rsrcfiles = ResourceFile::all();
        return view('moderator.mresources', ['rsrcfiles' => $rsrcfiles]);
    }

    public function uploadResource(Request $request){
        // dd($request);
        $data = $request->validate([
            'documentTitle' => 'required',
            'documentDesc' => 'nullable',
            'documentFile' => 'required',
        ]);
        $newFile = ResourceFile::create($data);

        return $this->showMresources();
    }

    public function destroyResource(ResourceFile $rsrcfile){
        $rsrcfile->delete();
        return $this->showMresources();
    }

    public function updateResource(Request $request, $id)
    {
        $resource = ResourceFile::findOrFail($id);
    
        $request->validate([
            'documentTitle' => 'required|string|max:50',
            'documentDesc' => 'required|string|max:250',
            'documentFile' => 'nullable|file',
        ]);
    
        $resource->documentTitle = $request->input('documentTitle');
        $resource->documentDesc = $request->input('documentDesc');
    
        if ($request->hasFile('documentFile')) {
            $filePath = $request->file('documentFile')->store('documents', 'public'); 
            $resource->documentFile = $filePath;
        }
    
        $resource->save();    

        return $this->showMresources();
    }
}