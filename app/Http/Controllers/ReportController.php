<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // Function to handle report submission
    public function submitReport(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'post_id' => 'required|string|max:20',
            'reportContent' => 'required|string|max:100',
        ]);

        // Create a unique report ID
        $reportId = uniqid('rep_');

        // Store the report
        $report = Report::create([
            'report_id' => $reportId,
            'post_id' => $validated['post_id'],
            'user_id' => Auth::user()->user_id,  // Assuming the user is logged in
            'reportContent' => $validated['reportContent'],
        ]);

        // You can return a response or redirect as needed
        return response()->json([
            'message' => 'Report submitted successfully',
            'report' => $report
        ], 200);
    }
}
