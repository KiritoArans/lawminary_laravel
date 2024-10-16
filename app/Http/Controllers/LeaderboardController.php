<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Leaderboard;
use App\Models\Point;
use App\Models\UserAccount;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function getLeaderboardsData()
    {
        $lawyers = DB::table('tblpoints')
            ->join(
                'tblaccounts',
                'tblpoints.lawyerUser_id',
                '=',
                'tblaccounts.user_id'
            ) // Join with tblaccounts to get username
            ->select(
                'tblpoints.lawyerUser_id',
                'tblaccounts.username', // Select username from tblaccounts
                DB::raw('SUM(tblpoints.points) as total_points')
            )
            ->groupBy('tblpoints.lawyerUser_id', 'tblaccounts.username') // Group by lawyerUser_id and username
            ->get();

        // Iterate through the list of lawyers and assign rank
        foreach ($lawyers as $lawyer) {
            $rank = '';

            // Assign badge based on total points
            if ($lawyer->total_points >= 5000) {
                $rank = 'Diamond';
            } elseif ($lawyer->total_points >= 3500) {
                $rank = 'Gold';
            } elseif ($lawyer->total_points >= 2000) {
                $rank = 'Silver';
            } elseif ($lawyer->total_points >= 1000) {
                $rank = 'Bronze';
            } elseif ($lawyer->total_points >= 500) {
                $rank = 'Steel';
            } else {
                $rank = 'Wood';
            }

            // Insert or update the lawyer's record in the leaderboards table
            Leaderboard::updateOrInsert(
                ['lawyerUser_id' => $lawyer->lawyerUser_id],
                [
                    'username' => $lawyer->username, // Insert the username
                    'rankPoints' => $lawyer->total_points,
                    'rank' => $rank,
                    'updated_at' => now(),
                ]
            );
        }
        // Retrieve the leaderboards data along with user name by joining with tblaccounts
        $leaderboards = DB::table('tblleaderboards')
            ->join(
                'tblaccounts',
                'tblleaderboards.lawyerUser_id',
                '=',
                'tblaccounts.user_id'
            ) // Adjusted join condition
            ->select('tblleaderboards.*', 'tblaccounts.username', 'tblaccounts.firstName', 'tblaccounts.lastName') // Select leaderboards data and username
            ->orderBy('tblleaderboards.rankPoints', 'desc')
            ->paginate(10);

        return $leaderboards;
    }


    public function leaderboards()
    {
        // Calculate the total points for each lawyer and get the username from tblaccounts
        $lawyers = DB::table('tblpoints')
            ->join(
                'tblaccounts',
                'tblpoints.lawyerUser_id',
                '=',
                'tblaccounts.user_id'
            ) // Join with tblaccounts to get username
            ->select(
                'tblpoints.lawyerUser_id',
                'tblaccounts.username', // Select username from tblaccounts
                DB::raw('SUM(tblpoints.points) as total_points')
            )
            ->groupBy('tblpoints.lawyerUser_id', 'tblaccounts.username') // Group by lawyerUser_id and username
            ->get();

        // Iterate through the list of lawyers and assign rank
        foreach ($lawyers as $lawyer) {
            $rank = '';

            // Assign badge based on total points
            if ($lawyer->total_points >= 5000) {
                $rank = 'Diamond';
            } elseif ($lawyer->total_points >= 3500) {
                $rank = 'Gold';
            } elseif ($lawyer->total_points >= 2000) {
                $rank = 'Silver';
            } elseif ($lawyer->total_points >= 1000) {
                $rank = 'Bronze';
            } elseif ($lawyer->total_points >= 500) {
                $rank = 'Steel';
            } else {
                $rank = 'Wood';
            }

            // Insert or update the lawyer's record in the leaderboards table
            Leaderboard::updateOrInsert(
                ['lawyerUser_id' => $lawyer->lawyerUser_id],
                [
                    'username' => $lawyer->username, // Insert the username
                    'rankPoints' => $lawyer->total_points,
                    'rank' => $rank,
                    'updated_at' => now(),
                ]
            );
        }

        // Retrieve the leaderboards data along with user name by joining with tblaccounts
        $leaderboards = DB::table('tblleaderboards')
            ->join(
                'tblaccounts',
                'tblleaderboards.lawyerUser_id',
                '=',
                'tblaccounts.user_id'
            ) // Adjusted join condition
            ->select('tblleaderboards.*', 'tblaccounts.username') // Select leaderboards data and username
            ->orderBy('tblleaderboards.rankPoints', 'desc')
            ->paginate(10);

        // Pass the data to the view
        return view('moderator.mleaderboards', compact('leaderboards'));
    }

    //filter leaderboards

    public function filterLeaderboards(Request $request)
    {
        // Start a query
        $query = UserAccount::query();

        // Apply filters if provided
        if ($request->filled('filter_user_id')) {
            $query->where('user_id', $request->input('filter_user_id'));
        }
        if ($request->filled('filterRank')) {
            $query->where(
                'rank',
                'like',
                '%' . $request->input('filterRank') . '%'
            );
        }
        if ($request->filled('filterName')) {
            $query->where(
                'username',
                'like',
                '%' . $request->input('filterName') . '%'
            );
        }

        if ($request->filled('filterPoints')) {
            $filterPoints = $request->input('filterPoints');

            // Handle special case for "5001+" (which means greater than 5001)
            if ($filterPoints == '5001+') {
                $query->where('points', '>', 5000);
            } else {
                // Split the range into two parts, start and end
                [$minPoints, $maxPoints] = explode('-', $filterPoints);

                // Add the range condition to the query
                $query->whereBetween('points', [
                    (int) $minPoints,
                    (int) $maxPoints,
                ]);
            }
        }

        if ($request->filled('filterBadge')) {
            $query->where(
                'badge',
                'like',
                '%' . $request->input('filterBadge') . '%'
            );
        }

        // Paginate results
        $lawyers = $query->paginate(10);

        // Return the view with the filtered results
        return view('moderator.mleaderboards', compact('lawyers'));
    }
    // New search function
    public function search(Request $request)
    {
        $searchTerm = $request->input('query');

        // Search leaderboards based on username or rank
        $leaderboards = Leaderboard::where(
            'username',
            'LIKE',
            "%{$searchTerm}%"
        )
            ->orWhere('rank', 'LIKE', "%{$searchTerm}%")
            ->orderBy('rankPoints', 'desc')
            ->paginate(10);

        // Pass the search term to the view for pagination and display
        $leaderboards->appends(['query' => $searchTerm]);

        return view('moderator.mleaderboards', compact('leaderboards'));
    }

    // New filter function
    public function filter(Request $request)
    {
        // Retrieve filter inputs
        $filterRank = $request->input('filterRank');
        $filterMinPoints = $request->input('filterMinPoints');
        $filterMaxPoints = $request->input('filterMaxPoints');

        // Build the query for filtering
        $query = Leaderboard::query();

        // Apply rank filter
        if ($filterRank) {
            $query->where('rank', $filterRank);
        }

        // Apply points filter
        if ($filterMinPoints) {
            $query->where('rankPoints', '>=', $filterMinPoints);
        }

        if ($filterMaxPoints) {
            $query->where('rankPoints', '<=', $filterMaxPoints);
        }

        // Order the results by points and paginate
        $leaderboards = $query->orderBy('rankPoints', 'desc')->paginate(10);

        // Pass filters to pagination links
        $leaderboards->appends([
            'filterRank' => $filterRank,
            'filterMinPoints' => $filterMinPoints,
            'filterMaxPoints' => $filterMaxPoints,
        ]);

        return view('moderator.mleaderboards', compact('leaderboards'));
    }
}
