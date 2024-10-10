<div class="table-container">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Forum ID</th>
                <th>Forum Name</th>
                <th>Forum Description</th>
                <th>Members Count</th>
                <th>Date Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="forumsTableBody">
            @foreach ($forums as $forum)
                <tr>
                    <td>{{ $forum->forum_id }}</td>
                    <td>{{ $forum->forumName }}</td>
                    <td>{{ $forum->forumDesc }}</td>
                    <td>{{ $forum->membersCount }}</td>
                    <td>
                        {{ \Carbon\Carbon::parse($forum->created_at)->format('Y-m-d') }}
                    </td>
                    <td>
                        <!-- Edit Button to open the modal -->
                        <button
                            class="custom-button edit-button"
                            data-forum-id="{{ $forum->forum_id }}"
                            data-forum-name="{{ $forum->forumName }}"
                            data-forum-desc="{{ $forum->forumDesc }}"
                            data-members-count="{{ $forum->membersCount }}"
                            data-date-created="{{ \Carbon\Carbon::parse($forum->created_at)->format('Y-m-d') }}"
                        >
                            Edit
                        </button>

                        <form
                            action="{{ route('moderator.deleteForum', ['forum_id' => $forum->forum_id]) }}"
                            method="POST"
                            style="display: inline-block"
                            class="delete-form"
                        >
                            @csrf
                            @method('DELETE')

                            <button
                                type="button"
                                class="custom-button delete-button"
                                onclick="confirmDelete(this)"
                            >
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for editing forum -->
    <div id="editForumModal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeEditForumModal">&times;</span>
            <h2>Edit Forum</h2>

            <!-- Edit Forum Form -->
            <form
                id="editForumForm"
                method="POST"
                action="{{ route('moderator.updateForum', ['forum_id' => ':forum_id']) }}"
            >
                @csrf

                <!-- Forum ID (readonly) -->
                <label for="editForumId">Forum ID:</label>
                <input type="text" id="editForumId" name="forum_id" readonly />

                <!-- Forum Name -->
                <label for="editForumName">Forum Name:</label>
                <input
                    type="text"
                    id="editForumName"
                    name="forumName"
                    required
                />

                <!-- Forum Description -->
                <label for="editForumDescription">Forum Description:</label>
                <input
                    type="text"
                    id="editForumDescription"
                    name="forumDesc"
                    required
                />

                <!-- Date Created -->
                <label for="editDateCreated">Date Created:</label>
                <input
                    type="date"
                    id="editDateCreated"
                    name="dateCreated"
                    required
                />

                <!-- Submit Button -->
                <button type="submit" class="custom-button">
                    Save Changes
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Centering Pagination Wrapper -->
<div class="pagination-wrapper d-flex justify-content-center mt-4">
    <ul class="pagination">
        <li
            class="page-item {{ $forums->currentPage() == 1 ? 'disabled' : '' }}"
            aria-disabled="{{ $forums->currentPage() == 1 }}"
        >
            <a
                class="page-link"
                href="{{ $forums->appends(request()->input())->previousPageUrl() }}"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        @for ($i = 1; $i <= $forums->lastPage(); $i++)
            <li
                class="page-item {{ $forums->currentPage() == $i ? 'active' : '' }}"
            >
                <a
                    class="page-link"
                    href="{{ $forums->appends(request()->input())->url($i) }}"
                >
                    {{ $i }}
                </a>
            </li>
        @endfor

        <li
            class="page-item {{ $forums->hasMorePages() ? '' : 'disabled' }}"
            aria-disabled="{{ ! $forums->hasMorePages() }}"
        >
            <a
                class="page-link"
                href="{{ $forums->appends(request()->input())->nextPageUrl() }}"
                rel="next"
            >
                &raquo;
            </a>
        </li>
    </ul>
</div>
