<meta name="csrf-token" content="{{ csrf_token() }}" />

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>User ID</th>
            <th>Rank</th>
            <th>Name</th>
            <th>Points</th>
            <th>Badge</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="postTableBody">
        @if ($lawyers->isEmpty())
            <tr>
                <td colspan="7">No results found.</td>
            </tr>
        @else
            @foreach ($lawyers as $activity)
                <tr>
                    <td>{{ $activity->user_id }}</td>
                    <td>
                        {{ $loop->iteration + $lawyers->perPage() * ($lawyers->currentPage() - 1) }}
                    </td>
                    <td>{{ $activity->username }}</td>
                    <td>{{ $activity->points }}</td>
                    <td>{{ $activity->badge }}</td>
                    <td>
                        <button
                            class="view-btn"
                            data-user_id="{{ $activity->user_id }}"
                            data-rank="{{ $loop->iteration }}"
                            data-username="{{ $activity->username }}"
                            data-points="{{ $activity->points }}"
                            data-badge="{{ $activity->badge }}"
                        >
                            View
                        </button>
                        @include('includes_leaderboards.view_lead_inc')
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<div class="paginationContent">
    <ul class="pagination">
        <li
            class="page-item {{ $lawyers->currentPage() == 1 ? 'disabled' : '' }}"
            aria-disabled="{{ $lawyers->currentPage() == 1 }}"
        >
            <a
                class="page-link"
                href="{{ $lawyers->appends(request()->input())->previousPageUrl() }}"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        @for ($i = 1; $i <= $lawyers->lastPage(); $i++)
            <li
                class="page-item {{ $lawyers->currentPage() == $i ? 'active' : '' }}"
            >
                <a
                    class="page-link"
                    href="{{ $lawyers->appends(request()->input())->url($i) }}"
                >
                    {{ $i }}
                </a>
            </li>
        @endfor

        <li
            class="page-item {{ $lawyers->hasMorePages() ? '' : 'disabled' }}"
            aria-disabled="{{ ! $lawyers->hasMorePages() }}"
        >
            <a
                class="page-link"
                href="{{ $lawyers->appends(request()->input())->nextPageUrl() }}"
                rel="next"
            >
                &raquo;
            </a>
        </li>
    </ul>
</div>

<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>
        <h2>Activity Details</h2>
        <div id="modalContent">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>
</div>
