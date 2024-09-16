<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAccount;

class LeaderboardController extends Controller
{
    public function leaderboards()
    {
        $lawyers = UserAccount::where('accountType', 'lawyer')
            ->orderBy('points', 'desc')
            ->paginate(10);

        return view('moderator.mleaderboards', compact('lawyers'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('query');

        $lawyers = UserAccount::where(
            'accountType',
            'lawyer',
            '%' . $searchQuery . '%'
        )
            ->orWhere('badge', 'like', '%' . $searchQuery . '%')
            ->orWhere('username', 'like', '%' . $searchQuery . '%')
            ->orWhere('user_id', 'like', '%' . $searchQuery . '%')
            ->orderBy('points', 'desc')
            ->paginate(10);

        return view('moderator.mleaderboards', compact('lawyers'))->with(
            'searchQuery',
            $searchQuery
        );
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
            $query->where(
                'points',
                'like',
                '%' . $request->input('filterPoints') . '%'
            );
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
}
