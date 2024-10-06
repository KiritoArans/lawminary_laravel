<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Method to handle AJAX request for dashboard data (daily, weekly, monthly, yearly)
    public function getDashboardData(Request $request)
    {
        $range = $request->input('range', 'weekly'); // Set 'weekly' as the default range

        switch ($range) {
            case 'daily':
                $data = $this->getDailyData();
                break;
            case 'weekly':
                $data = $this->getWeeklyData(); // Weekly data is now the default
                break;
            case 'monthly':
                $data = $this->getMonthlyData();
                break;
            case 'yearly':
                $data = $this->getYearlyData();
                break;
            default:
                $data = $this->getWeeklyData(); // Default to weekly
        }

        return response()->json([
            'barChart' => $data, // Data for the bar chart
            'pieChart' => $data, // You can use the same data for pie
            'lineGraph' => [
                'labels' => $data['labels'], // Make sure you're sending the labels
                'accounts' => $data['accounts'], // Number of accounts
                'posts' => $data['posts'], // Number of posts
                'forumPosts' => $data['forumPosts'], // Number of forum posts
                'feedbacks' => $data['feedbacks'], // Feedback data
            ],
        ]);
    }

    // Example method to get daily data (replace with real queries)
    private function getDailyData()
    {
        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();

        $accounts = DB::table('tblaccounts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $posts = DB::table('tblposts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $forumPosts = DB::table('tblforumposts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $feedbacks = DB::table('tblfeedbacks')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return [
            'labels' => [$startDate->format('Y-m-d')], // Label for the current day
            'accounts' => [$accounts],
            'posts' => [$posts],
            'forumPosts' => [$forumPosts],
            'feedbacks' => [$feedbacks], // Include feedbacks count
        ];
    }

    private function getWeeklyData()
    {
        $startDate = now()->startOfWeek();
        $endDate = now()->endOfWeek();

        $accounts = DB::table('tblaccounts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $posts = DB::table('tblposts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $forumPosts = DB::table('tblforumposts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $feedbacks = DB::table('tblfeedbacks')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return [
            'labels' => ['This Week'], // Replace with week labels if needed
            'accounts' => [$accounts],
            'posts' => [$posts],
            'forumPosts' => [$forumPosts],
            'feedbacks' => [$feedbacks],
        ];
    }

    private function getMonthlyData()
    {
        $startDate = now()->startOfMonth();
        $endDate = now()->endOfMonth();

        $accounts = DB::table('tblaccounts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $posts = DB::table('tblposts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $forumPosts = DB::table('tblforumposts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $feedbacks = DB::table('tblfeedbacks')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return [
            'labels' => ['This Month'], // Replace with week labels if needed
            'accounts' => [$accounts],
            'posts' => [$posts],
            'forumPosts' => [$forumPosts],
            'feedbacks' => [$feedbacks],
        ];
    }

    private function getYearlyData()
    {
        $startDate = now()->startOfYear();
        $endDate = now()->endOfYear();

        $accounts = DB::table('tblaccounts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $posts = DB::table('tblposts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $forumPosts = DB::table('tblforumposts')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        $feedbacks = DB::table('tblfeedbacks')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();

        return [
            'labels' => ['This Year'], // Replace with week labels if needed
            'accounts' => [$accounts],
            'posts' => [$posts],
            'forumPosts' => [$forumPosts],
            'feedbacks' => [$feedbacks],
        ];
    }

    public function getDataForChart(Request $request)
    {
        $range = $request->input('range', 'weekly');

        switch ($range) {
            case 'daily':
                $startDate = now()->startOfDay();
                $endDate = now()->endOfDay();
                $interval = 'HOUR'; // Group by hour
                break;
            case 'weekly':
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                $interval = 'DAY'; // Group by day
                break;
            case 'monthly':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                $interval = 'DAY'; // Group by day
                break;
            case 'yearly':
                $startDate = now()->startOfYear();
                $endDate = now()->endOfYear();
                $interval = 'MONTH'; // Group by month for yearly
                break;
            default:
                $startDate = now()->startOfWeek();
                $endDate = now()->endOfWeek();
                $interval = 'DAY'; // Default group by day
                break;
        }

        // Get all unique dates from all tables combined
        $dates = DB::table('tblaccounts')
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as date")
            )
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->union(
                DB::table('tblposts')
                    ->select(
                        DB::raw(
                            "DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as date"
                        )
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy('date')
            )
            ->union(
                DB::table('tblforumposts')
                    ->select(
                        DB::raw(
                            "DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as date"
                        )
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy('date')
            )
            ->union(
                DB::table('tblfeedbacks')
                    ->select(
                        DB::raw(
                            "DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as date"
                        )
                    )
                    ->whereBetween('created_at', [$startDate, $endDate])
                    ->groupBy('date')
            )
            ->orderBy('date')
            ->pluck('date');

        // Now fetch the actual data counts
        $data = [
            'labels' => $dates,

            'accounts' => DB::table('tblaccounts')
                ->select(
                    DB::raw(
                        "DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as date"
                    ),
                    DB::raw('count(*) as count')
                )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date')
                ->toArray(),

            'posts' => DB::table('tblposts')
                ->select(
                    DB::raw(
                        "DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as date"
                    ),
                    DB::raw('count(*) as count')
                )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date')
                ->toArray(),

            'forumPosts' => DB::table('tblforumposts')
                ->select(
                    DB::raw(
                        "DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as date"
                    ),
                    DB::raw('count(*) as count')
                )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date')
                ->toArray(),

            'feedbacks' => DB::table('tblfeedbacks')
                ->select(
                    DB::raw(
                        "DATE_FORMAT(created_at, '%Y-%m-%d %H:00:00') as date"
                    ),
                    DB::raw('count(*) as count')
                )
                ->whereBetween('created_at', [$startDate, $endDate])
                ->groupBy('date')
                ->orderBy('date')
                ->pluck('count', 'date')
                ->toArray(),
        ];

        // Transform the data so each dataset uses the unified 'labels' for the x-axis
        $transformedData = $this->transformData($dates, $data);

        return response()->json($transformedData);
    }

    private function transformData($dates, $data)
    {
        // Initialize the transformed data arrays
        $accounts = [];
        $posts = [];
        $forumPosts = [];
        $feedbacks = [];

        foreach ($dates as $date) {
            $accounts[] = $data['accounts'][$date] ?? 0;
            $posts[] = $data['posts'][$date] ?? 0;
            $forumPosts[] = $data['forumPosts'][$date] ?? 0;
            $feedbacks[] = $data['feedbacks'][$date] ?? 0;
        }

        return [
            'labels' => $dates,
            'accounts' => $accounts,
            'posts' => $posts,
            'forumPosts' => $forumPosts,
            'feedbacks' => $feedbacks,
        ];
    }

    // Similarly, define getWeeklyData(), getMonthlyData(), and getYearlyData() methods

    // Main dashboard method to render the view
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
        $dashboardData = $query->paginate(10);

        // Get the common dashboard counts (pending posts, accounts, etc.)
        $dashboardCounts = $this->getDashboardCounts();

        // Merge the recent activities with dashboard counts
        $data = array_merge($dashboardCounts, [
            'dashboardData' => $dashboardData,
        ]);

        // Render the correct view based on the route (admin or moderator)
        if (request()->is('admin*')) {
            return view('admin.dashboard', $data);
        } elseif (request()->is('moderator*')) {
            return view('moderator.dashboard', $data);
        }
    }

    // Helper function to get common dashboard counts (e.g., pending posts, accounts, etc.)
    private function getDashboardCounts()
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
}

//search function
//     public function search(Request $request)
//     {
//         $search = $request->input('search'); // Capture the search query

//         // Perform the search
//         if ($search) {
//             // Filter dashboard activities based on the search query (username or action)
//             $dashboardData = Dashboard::where(
//                 'act_action',
//                 'LIKE',
//                 '%' . $search . '%'
//             )
//                 ->orWhere('act_username', 'LIKE', '%' . $search . '%')
//                 ->paginate(10);
//         } else {
//             // If no search term, show all activities
//             $dashboardData = Dashboard::paginate(10); // Use paginate instead of get()
//         }

//         // Fetch the additional dashboard data
//         $dashboardCounts = $this->getDashboardData();

//         // Pass both the search results and the dashboard counts to the view
//         if (request()->is('admin*')) {
//             return view('admin.dashboard', [
//                 'dashboardData' => $dashboardData,
//                 'pendingPosts' => $dashboardCounts['pendingPosts'],
//                 'pendingAccounts' => $dashboardCounts['pendingAccounts'],
//                 'accountsCount' => $dashboardCounts['accountsCount'],
//                 'forumsCount' => $dashboardCounts['forumsCount'],
//             ]);
//         } elseif (request()->is('moderator*')) {
//             return view('moderator.dashboard', [
//                 'dashboardData' => $dashboardData,
//                 'pendingPosts' => $dashboardCounts['pendingPosts'],
//                 'pendingAccounts' => $dashboardCounts['pendingAccounts'],
//                 'accountsCount' => $dashboardCounts['accountsCount'],
//                 'forumsCount' => $dashboardCounts['forumsCount'],
//             ]);
//         }
//     }
// }
