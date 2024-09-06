<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Dashboard;

class DashboardController extends Controller
{
    public function recentAct()
    {
        // Fetch counts for pending posts, pending accounts, and accounts
        $pendingPosts = DB::table('tblposts')
            ->where('status', 'pending')
            ->count();

        $pendingAccounts = DB::table('tblaccounts')
            ->where('status', 'pending')
            ->count();

        $accountsCount = DB::table('tblaccounts')->count();

        $postsCount = DB::table('tblposts')->count();

        $commentsCount = DB::table('tblcomments')->count();

        $forumsCount = DB::table('tblforums')->count();

        // Fetch recent activities for the dashboard
        $recentActivities = DB::table('tbldashboard')
            ->orderBy('act_date', 'desc')
            ->get();

        // Return the view with the data for both pending counts and recent activities
        return view('admin.dashboard', [
            'pendingPosts' => $pendingPosts,
            'pendingAccounts' => $pendingAccounts,
            'accountsCount' => $accountsCount,
            'recentActivities' => $recentActivities,
            'postsCount' => $postsCount,
            'commentsCount' => $commentsCount,
            'forumsCount' => $forumsCount,
        ]);
    }

    //filter dashboard
    public function filterDashboard(Request $request)
    {
        // Start with a query builder for filtering recent activities
        $query = Dashboard::query();

        // Apply filters based on the request inputs
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

        // Fetch filtered activities
        $recentActivities = $query->get();

        // Also fetch data for the boxes
        $pendingPosts = DB::table('tblposts')
            ->where('status', 'pending')
            ->count();
        $pendingAccounts = DB::table('tblaccounts')
            ->where('status', 'pending')
            ->count();
        $accountsCount = DB::table('tblaccounts')->count();

        $postsCount = DB::table('tblposts')->count();

        $commentsCount = DB::table('tblcomments')->count();

        $forumsCount = DB::table('tblforums')->count();

        // Return the view with both filtered and unfiltered data
        return view('admin.dashboard', [
            'recentActivities' => $recentActivities,
            'pendingPosts' => $pendingPosts,
            'pendingAccounts' => $pendingAccounts,
            'accountsCount' => $accountsCount,
            'postsCount' => $postsCount,
            'commentsCount' => $commentsCount,
            'forumsCount' => $forumsCount,
        ]);
    }
}
