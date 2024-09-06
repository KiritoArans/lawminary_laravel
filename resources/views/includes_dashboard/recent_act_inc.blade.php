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
    <tbody>
        @foreach ($recentActivities as $activity)
            <tr>
                <td>{{ $activity->id }}</td>
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
