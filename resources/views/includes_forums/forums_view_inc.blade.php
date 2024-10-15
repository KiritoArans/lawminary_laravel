<div class="table-container">
    <p>*click cell to view data</p>
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
                    <td
                        class="clickable-cell"
                        data-full-text="{{ $forum->forum_id }}"
                    >
                        {{ Str::limit($forum->forum_id, 10) }}
                    </td>
                    <td>
                        @if ($forum->forumPhoto)
                            <img
                                src="{{ Storage::url($forum->forumPhoto) }}"
                                alt=" Photo"
                                width="50"
                                height="50"
                                class="clickable-photo"
                                data-fullsize="{{ Storage::url($forum->forumPhoto) }}"
                            />
                        @else
                            <img
                                src="{{ asset('imgs/user-img.png') }}"
                                alt="No Photo Available"
                                width="50"
                                height="50"
                                class="clickable-photo"
                                data-fullsize="{{ asset('imgs/user-img.png') }}"
                            />
                        @endif
                    </td>
                    <td
                        class="clickable-cell"
                        data-full-text="{{ $forum->forumName }}"
                    >
                        {{ Str::limit($forum->forumName, 15) }}
                    </td>
                    <td
                        class="clickable-cell"
                        data-full-text="{{ $forum->forumDesc }}"
                    >
                        {{ Str::limit($forum->forumDesc, 25) }}
                    </td>
                    <td
                        class="clickable-cell"
                        data-full-text="{{ $forum->membersCount }}"
                    >
                        {{ Str::limit($forum->membersCount, 5) }}
                    </td>
                    <td
                        class="clickable-cell"
                        data-full-text="{{ \Carbon\Carbon::parse($forum->created_at)->format('Y-m-d') }}"
                    >
                        {{ Str::limit(\Carbon\Carbon::parse($forum->created_at)->format('Y-m-d'), 10) }}
                    </td>

                    <td>
                        <!-- Edit Button to open the modal -->
                        <button
                            class="custom-button edit-button"
                            data-forum-id="{{ $forum->forum_id }}"
                            data-forum-name="{{ $forum->forumName }}"
                            data-forum-desc="{{ $forum->forumDesc }}"
                            data-date-created="{{ \Carbon\Carbon::parse($forum->created_at)->format('Y-m-d') }}"
                            onclick="openEditForumModal(this)"
                        >
                            Edit
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal for editing forum -->
    <div id="editForumModal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeEditForumModal">&times;</span>

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
                    readonly
                />

                <!-- Submit Button -->
                <button type="submit" class="custom-button">
                    Save Changes
                </button>
            </form>

            <!-- Delete Forum Form (Inside the Modal) -->
            <form
                id="deleteForumForm"
                method="POST"
                class="delete-form"
                style="margin-top: 20px"
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

<!-- Modal Structure -->
<div id="imageModalPic" class="modalPic" style="display: none">
    <span class="close-modalPic" id="closeModalPic">&times;</span>
    <img
        id="fullImage"
        src=""
        alt="Full Image"
        style="width: 50%; height: 50%"
    />
</div>
