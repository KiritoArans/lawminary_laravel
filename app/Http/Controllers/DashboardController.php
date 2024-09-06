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
            'postsCount' => DB::table('tblposts')->count(),
            'commentsCount' => DB::table('tblcomments')->count(),
            'forumsCount' => DB::table('tblforums')->count(),
        ];
    }

    // Fetch recent activities with or without filters
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
            $query->where(
                'act_date',
                'like',
                '%' . $request->input('filterDate') . '%'
            );
        }

        // Fetch recent activities
        $recentActivities = $query->get();

        // Get the common dashboard data (for boxes)
        $dashboardData = $this->getDashboardData();

        // Merge the recent activities with dashboard data
        $data = array_merge($dashboardData, [
            'recentActivities' => $recentActivities,
        ]);

        // Render the correct view based on the route (admin or moderator)
        if (request()->is('admin*')) {
            return view('admin.dashboard', $data);
        } elseif (request()->is('moderator*')) {
            return view('moderator.mdashboard', $data);
        }
    }
}
