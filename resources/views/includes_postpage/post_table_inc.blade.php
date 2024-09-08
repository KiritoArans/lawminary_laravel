<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Post ID</th>
            <th>Concern</th>
            <th>Status</th>
            <th>Tags</th>
            <th>Posted By</th>
            <th>Approved by</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody id="postTableBody">
        @if ($recentActivities->isEmpty())
            <tr>
                <td colspan="7">No results found.</td>
            </tr>
        @else
            @foreach ($recentActivities as $activity)
                <tr>
                    <td>{{ $activity->post_id }}</td>
                    <td>{{ $activity->concern }}</td>
                    <td>{{ $activity->status }}</td>
                    <td>{{ $activity->tags }}</td>
                    <td>{{ $activity->postedBy }}</td>
                    <td>{{ $activity->approvedBy }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($activity->updated_at)->format('Y-m-d') }}
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
