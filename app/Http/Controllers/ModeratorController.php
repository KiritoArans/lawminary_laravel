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
        // $rsrcfiles = DB::table('tblresources')->get();
        $rsrcfiles = ResourceFile::all();
        return view('moderator.mresources', ['rsrcfiles' => $rsrcfiles]);
    }
    // public function show($id)
    // {
    //     $rsrcfile = ResourceFile::findOrFail($id);
    //     return view('moderator.mresources', compact('rsrcfile'));
    // }

    // public function viewResource(Request $request)
    // {
    //     // Retrieve the resource file based on the submitted ID
    //     $rsrcfile = ResourceFile::find($request->id);
    //     return view('moderator.mresources', ['rsrcfile' => $rsrcfile]);
    // }

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
}