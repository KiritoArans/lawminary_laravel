<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    // Helper function to get common dashboard data (boxes)
    private function getDashboardData()
    {
        return [
            'pendingPosts' => DB::table('tblposts')
                ->where('status', 'pending')
                ->count(),
            'pendingAccounts' => DB::table('tblaccounts')
                ->where('status', 'pending')
                ->count(),
            'accountsCount' => DB::table('tblaccounts')->count(),
            'forumsCount' => DB::table('tblforums')->count(),
        ];
    }

    // Fetch recent activities with or without filters
    // Fetch recent activities with or without filters and search
    public function dashboard(Request $request)
    {
        // Start with a query builder for recent activities
        $query = DB::table('tbldashboard')->orderBy('act_date', 'desc');

        // Apply filters based on the request inputs (if any)
        if ($request->filled('filterId')) {
            $query->where('act_id', $request->input('filterId'));
        }

        if ($request->filled('filterUsername')) {
            $query->where(
                'act_username',
                'like',
                '%' . $request->input('filterUsername') . '%'
            );
        }

        if ($request->filled('filterAction')) {
            $query->where(
                'act_action',
                'like',
                '%' . $request->input('filterAction') . '%'
            );
        }

        if ($request->filled('filterDate')) {
            $query->whereDate('act_date', $request->input('filterDate'));
        }

        // Apply search functionality based on the 'search' input
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query
                    ->where('act_username', 'LIKE', '%' . $search . '%')
                    ->orWhere('act_action', 'LIKE', '%' . $search . '%');
            });
        }

        // Fetch the filtered and/or searched results
        $dashboardData = $query->get();

        // Get the common dashboard data (for boxes, pending posts, accounts, etc.)
        $dashboardCounts = $this->getDashboardData();

        $dashboardData = $query->paginate(10);

        // Merge the recent activities with dashboard counts
        $data = array_merge($dashboardCounts, [
            'dashboardData' => $dashboardData,
        ]);

        // Render the correct view based on the route (admin or moderator)
        if (request()->is('admin*')) {
            return view('admin.dashboard', $data);
        } elseif (request()->is('moderator*')) {
            return view('moderator.mdashboard', $data);
        }
    }

    //search function
    public function search(Request $request)
    {
        $search = $request->input('search'); // Capture the search query

        // Perform the search
        if ($search) {
            // Filter dashboard activities based on the search query (username or action)
            $dashboardData = Dashboard::where(
                'act_action',
                'LIKE',
                '%' . $search . '%'
            )
                ->orWhere('act_username', 'LIKE', '%' . $search . '%')
                ->get();
        } else {
            // If no search term, show all activities
            $dashboardData = Dashboard::all();
        }

        // Fetch the additional dashboard data
        $dashboardCounts = $this->getDashboardData();

        // Pass both the search results and the dashboard counts to the view
        return view('admin.dashboard', [
            'dashboardData' => $dashboardData,
            'pendingPosts' => $dashboardCounts['pendingPosts'],
            'pendingAccounts' => $dashboardCounts['pendingAccounts'],
            'accountsCount' => $dashboardCounts['accountsCount'],
            'forumsCount' => $dashboardCounts['forumsCount'],
        ]);
    }
}
