<!-- resources/views/admin/dashboard.blade.php<table class="table" id="dashboardTableBody">
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

<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close-buttonView" id="closeModal">&times;</span>
        <h2>Activity Details</h2>
        <div id="modalContent">
        </div>
    </div>
</div>
 -->

<!-- resources/views/admin/dashboard.blade.php -->

<!-- Time Filter Buttons -->
<div class="time-filter">
    <button id="daily" onclick="filterData('daily')" class="custom-button">
        Daily
    </button>
    <button id="weekly" onclick="filterData('weekly')" class="custom-button">
        Weekly
    </button>
    <button id="monthly" onclick="filterData('monthly')" class="custom-button">
        Monthly
    </button>
    <button id="yearly" onclick="filterData('yearly')" class="custom-button">
        Yearly
    </button>
</div>

<!-- Chart Canvas -->
<canvas id="myChart" width="400" height="200"></canvas>

<!-- Remove the table and pagination since you're replacing this with the chart -->
