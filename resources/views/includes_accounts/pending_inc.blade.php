<!-- Button to trigger modal -->
<button id="viewPendingButton" class="custom-button">
    View Pending Accounts
</button>

<!-- Modal structure -->
<div id="pendingAccountsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>
        <h2>Pending Accounts</h2>

        <!-- Pending Accounts Table -->
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Account ID</th>
                    <th>Username</th>
                    <th>LN, FN, MI</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingAcc as $pending)
                    @include('inclusions.response')
                    <tr>
                        <td>{{ $pending->id }}</td>
                        <td>{{ $pending->username }}</td>
                        <td>
                            {{ $pending->lastName . ', ' . $pending->firstName . ', ' . $pending->middleName }}
                        </td>
                        <td>{{ $pending->email }}</td>
                        <td>{{ $pending->status }}</td>
                        <td>{{ $pending->created_at }}</td>
                        <td>
                            <div class="action-cell">
                                <!-- Approve Form -->
                                <form
                                    action="{{ route('admin.approveAccount', $pending->id) }}"
                                    method="POST"
                                    style="display: inline-block"
                                >
                                    @csrf
                                    <button
                                        type="submit"
                                        name="approve"
                                        class="btn-view-approve"
                                    >
                                        Approve
                                    </button>
                                </form>

                                <!-- Delete Form -->
                                <form
                                    id="delete-form-{{ $pending->id }}"
                                    method="POST"
                                    style="display: inline"
                                    action="{{ request()->is('moderator*') ? route('moderator.destroyAccount', $pending->id) : route('admin.destroyAccount', $pending->id) }}"
                                >
                                    @csrf
                                    @method('DELETE')
                                    @include('inclusions.response')
                                    <button
                                        type="button"
                                        class="delete-button"
                                        data-account-id="{{ $pending->id }}"
                                    >
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination inside the modal -->
        <div class="paginationContent">
            <ul class="pagination">
                <li
                    class="page-item {{ $pendingAcc->currentPage() == 1 ? 'disabled' : '' }}"
                    aria-disabled="{{ $pendingAcc->currentPage() == 1 }}"
                >
                    <a
                        class="page-link"
                        href="{{ $pendingAcc->appends(request()->input())->previousPageUrl() }}&modal=true"
                        rel="prev"
                    >
                        &laquo;
                    </a>
                </li>

                @for ($i = 1; $i <= $pendingAcc->lastPage(); $i++)
                    <li
                        class="page-item {{ $pendingAcc->currentPage() == $i ? 'active' : '' }}"
                    >
                        <a
                            class="page-link"
                            href="{{ $pendingAcc->appends(request()->input())->url($i) }}&modal=true"
                        >
                            {{ $i }}
                        </a>
                    </li>
                @endfor

                <li
                    class="page-item {{ $pendingAcc->hasMorePages() ? '' : 'disabled' }}"
                    aria-disabled="{{ ! $pendingAcc->hasMorePages() }}"
                >
                    <a
                        class="page-link"
                        href="{{ $pendingAcc->appends(request()->input())->nextPageUrl() }}&modal=true"
                        rel="next"
                    >
                        &raquo;
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
