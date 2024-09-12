<!-- resources/views/admin/dashboard.blade.php -->
<table class="table" id="dashboardTableBody">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Action</th>
            <th>Date</th>
            <th>View</th>
        </tr>
    </thead>
    <h1>Recent Activities</h1>
    <tbody>
        @foreach ($dashboardData as $activity)
            <tr>
                <td>{{ $activity->act_id }}</td>
                <td>{{ $activity->act_username }}</td>
                <td>{{ $activity->act_action }}</td>
                <td>
                    {{ \Carbon\Carbon::parse($activity->act_date)->format('Y-m-d') }}
                </td>
                <td>
                    <button
                        class="btn btn-view btn-sm"
                        data-id="{{ $activity->id }}"
                    >
                        View
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<ul class="pagination">
    <li
        class="page-item {{ $dashboardData->currentPage() == 1 ? 'disabled' : '' }}"
        aria-disabled="{{ $dashboardData->currentPage() == 1 }}"
    >
        <a
            class="page-link"
            href="{{ $dashboardData->appends(request()->input())->previousPageUrl() }}"
            rel="prev"
        >
            &laquo;
        </a>
    </li>

    @for ($i = 1; $i <= $dashboardData->lastPage(); $i++)
        <li
            class="page-item {{ $dashboardData->currentPage() == $i ? 'active' : '' }}"
        >
            <a
                class="page-link"
                href="{{ $dashboardData->appends(request()->input())->url($i) }}"
            >
                {{ $i }}
            </a>
        </li>
    @endfor

    <li
        class="page-item {{ $dashboardData->hasMorePages() ? '' : 'disabled' }}"
        aria-disabled="{{ ! $dashboardData->hasMorePages() }}"
    >
        <a
            class="page-link"
            href="{{ $dashboardData->appends(request()->input())->nextPageUrl() }}"
            rel="next"
        >
            &raquo;
        </a>
    </li>
</ul>

<!-- Modal Structure -->
<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>
        <h2>Activity Details</h2>
        <div id="modalContent">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>
</div>
