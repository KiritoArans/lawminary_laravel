<meta name="csrf-token" content="{{ csrf_token() }}" />

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
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="postTableBody">
        @if ($posts->isEmpty())
            <tr>
                <td colspan="7">No results found.</td>
            </tr>
        @else
            @foreach ($posts as $activity)
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
                    <td>
                        <button
                            class="btn btn-warning editButton"
                            data-id="{{ $activity->id }}"
                            data-concern="{{ $activity->concern }}"
                            data-status="{{ $activity->status }}"
                            data-tags="{{ $activity->tags }}"
                            data-postedby="{{ $activity->postedBy }}"
                            data-approvedby="{{ $activity->approvedBy }}"
                        >
                            Edit
                        </button>
                        @include('includes_postpage.post_edit_inc', ['postDelete' => $activity])
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

<div class="paginationContent">
    <ul class="pagination">
        <li
            class="page-item {{ $posts->currentPage() == 1 ? 'disabled' : '' }}"
            aria-disabled="{{ $posts->currentPage() == 1 }}"
        >
            <a
                class="page-link"
                href="{{ $posts->appends(request()->input())->previousPageUrl() }}"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        @for ($i = 1; $i <= $posts->lastPage(); $i++)
            <li
                class="page-item {{ $posts->currentPage() == $i ? 'active' : '' }}"
            >
                <a
                    class="page-link"
                    href="{{ $posts->appends(request()->input())->url($i) }}"
                >
                    {{ $i }}
                </a>
            </li>
        @endfor

        <li
            class="page-item {{ $posts->hasMorePages() ? '' : 'disabled' }}"
            aria-disabled="{{ ! $posts->hasMorePages() }}"
        >
            <a
                class="page-link"
                href="{{ $posts->appends(request()->input())->nextPageUrl() }}"
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
