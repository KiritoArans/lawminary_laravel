<!-- Button to trigger modal -->
<button id="viewPendingButton" class="custom-button">
    View Pending Accounts
</button>

<!-- Modal structure -->
<div id="pendingAccountsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>

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
                                        <img
                                            src="{{ asset('imgs/buttons/approve.png') }}"
                                            alt="Approve Button"
                                            width="35"
                                        />
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
                                        id="btn-view-reject"
                                        data-account-id="{{ $pending->id }}"
                                    >
                                        <img
                                            src="{{ asset('imgs/buttons/reject.png') }}"
                                            alt="Approve Button"
                                            width="35"
                                        />
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
