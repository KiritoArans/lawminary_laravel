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
                    <th>
                        Username
                        <h6>click the id picture to view*</h6>
                    </th>
                    <th>LN, FN, MI</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created at</th>
                    <th>Actions</th>
                    ss
                </tr>
            </thead>
            <tbody>
                @foreach ($pendingAcc as $pending)
                    @include('inclusions.response')
                    <tr>
                        <td>
                            @if ($pending->idPhoto)
                                <img
                                    src="{{ Storage::url($pending->idPhoto) }}"
                                    alt="ID Photo"
                                    width="50"
                                    height="50"
                                    class="clickable-id-photo"
                                    onclick="showIdPhotoModal('{{ Storage::url($pending->idPhoto) }}')"
                                />
                            @else
                                <img
                                    src="{{ asset('imgs/no-id-photo.png') }}"
                                    alt="No ID Photo Available"
                                    width="50"
                                    height="50"
                                />
                            @endif
                        </td>

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
                                    action="{{ request()->is('admin*') ? route('admin.approveAccount', $pending->id) : route('moderator.approveAccount', $pending->id) }}"
                                    method="POST"
                                    style="display: inline-block"
                                >
                                    @csrf
                                    <button
                                        type="submit"
                                        name="approve"
                                        class="btn-view-approve"
                                    >
                                        <i class="fa-solid fa-check"></i>
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
                                        class="btn-view-reject"
                                        data-account-id="{{ $pending->id }}"
                                    >
                                        <i class="fa-solid fa-x"></i>
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

<!-- Modal for ID Photo -->
<div id="idPhotoModal" class="modalPic" style="display: none">
    <div class="close-modalPic" onclick="closeIdPhotoModal()">&times;</div>
    <img id="idPhotoModalImage" src="" alt="ID Photo" />
</div>
