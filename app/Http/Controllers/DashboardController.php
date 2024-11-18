<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF; // Import PDF from dompdf
use Illuminate\Support\Facades\Storage; // <-- Import Storage facade

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

    public function getPostEngagementData(Request $request)
    {
        $range = $request->input('range', 'weekly'); // Default to 'weekly'

        $query = DB::table('tblposts')
            ->where('status', 'Approved')
            ->select('post_id', 'created_at');

        switch ($range) {
            case 'daily':
                $query->where('created_at', '>=', now()->subDay());
                break;
            case 'weekly':
                $query->where('created_at', '>=', now()->subWeek());
                break;
            case 'monthly':
                $query->where('created_at', '>=', now()->subMonth());
                break;
            case 'yearly':
                $query->where('created_at', '>=', now()->subYear());
                break;
        }

        $postData = $query->get()->map(function ($post) {
            $post->likes_count = DB::table('tbllikes')
                ->where('post_id', $post->post_id)
                ->count();
            $post->comments_count = DB::table('tblcomments')
                ->where('post_id', $post->post_id)
                ->count();
            $post->time_since_approval = now()->diffInHours($post->created_at);
            $post->total_engagement =
                $post->likes_count + $post->comments_count;
            return $post;
        });

        return response()->json($postData);
    }

    public function getLawyerResponseData(Request $request)
    {
        $range = $request->input('range', 'weekly'); // Default to 'weekly'

        $query = DB::table('tblcomments')
            ->join(
                'tblaccounts',
                'tblcomments.user_id',
                '=',
                'tblaccounts.user_id'
            )
            ->join('tblposts', 'tblcomments.post_id', '=', 'tblposts.post_id')
            ->where('tblaccounts.accountType', 'Lawyer');

        // Apply time filter based on the range
        switch ($range) {
            case 'daily':
                $query->where('tblcomments.created_at', '>=', now()->subDay());
                break;
            case 'weekly':
                $query->where('tblcomments.created_at', '>=', now()->subWeek());
                break;
            case 'monthly':
                $query->where(
                    'tblcomments.created_at',
                    '>=',
                    now()->subMonth()
                );
                break;
            case 'yearly':
                $query->where('tblcomments.created_at', '>=', now()->subYear());
                break;
        }

        // Get lawyer response data
        $lawyerData = $query
            ->select(
                'tblcomments.user_id',
                'tblaccounts.username',
                DB::raw(
                    'AVG(TIMESTAMPDIFF(HOUR, tblposts.created_at, tblcomments.created_at)) as avg_response_time'
                ),
                DB::raw('COUNT(tblcomments.post_id) as posts_handled')
            )
            ->groupBy('tblcomments.user_id', 'tblaccounts.username')
            ->get();

        return response()->json($lawyerData);
    }

    public function getUserRatingData(Request $request)
    {
        $range = $request->input('range', 'weekly'); // Default to 'weekly'

        $query = DB::table('tblrates')->join(
            'tblaccounts',
            'tblrates.lawyerUser_id',
            '=',
            'tblaccounts.user_id'
        );

        // Apply time filter based on the range
        switch ($range) {
            case 'daily':
                $query->where('tblrates.created_at', '>=', now()->subDay());
                break;
            case 'weekly':
                $query->where('tblrates.created_at', '>=', now()->subWeek());
                break;
            case 'monthly':
                $query->where('tblrates.created_at', '>=', now()->subMonth());
                break;
            case 'yearly':
                $query->where('tblrates.created_at', '>=', now()->subYear());
                break;
        }

        // Get lawyer rating data
        $lawyerRatings = $query
            ->select(
                'tblaccounts.user_id',
                'tblaccounts.username',
                DB::raw('AVG(tblrates.rate) as avg_rating'),
                DB::raw('COUNT(tblrates.rate) as posts_responded')
            )
            ->groupBy('tblaccounts.user_id', 'tblaccounts.username')
            ->get();

        return response()->json($lawyerRatings);
    }

    public function generateDailyReport()
    {
        // Fetch system configuration data (assuming this is how you fetch $sysconData)
        $sysconData = DB::table('tblsyscon')->get();

        // Determine the logo path based on the conditions from your Blade include
        if (
            $sysconData->isNotEmpty() &&
            !empty($sysconData->first()->logo_path)
        ) {
            // Get the logo path from storage (must be an absolute path for PDF)
            $logoPath = storage_path(
                'app/public/' . $sysconData->first()->logo_path
            );
        } else {
            // Use default logo path if sysconData is not available or logo path is empty
            $logoPath = public_path('imgs/Lawminary_Logo_2-Gold.png');
        }

        // Fetch the data you need for the daily report
        $reportData = [
            'title' => 'Daily Report',
            'date' => now()->format('Y-m-d'),
            'content' => 'This is the content of the daily report.',
            'logo' => $logoPath,
        ];

        // Load the data into the PDF view
        $pdf = PDF::loadView('reports.daily', $reportData);

        // Download the generated PDF
        return $pdf->download(
            'daily_report_' . now()->format('Y-m-d') . '.pdf'
        );
    }
}
