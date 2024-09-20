<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Display Photo</th>
            <th>Username</th>
            <th>LN, FN, MI</th>
            <th>E-mail</th>
            <th>Account Type</th>
            <th>Sex</th>
            <th>status</th>
            <th>Restrict | Restrict Days</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody id="accountTableBody">
        @foreach ($accounts as $account)
            <tr>
                <td>{{ $account->id }}</td>
                <td>
                    @if ($account->userPhoto)
                        <img
                            src="{{ Storage::url($account->userPhoto) }}"
                            alt="User Photo"
                            width="50"
                            height="50"
                            class="clickable-photo"
                            data-fullsize="{{ Storage::url($account->userPhoto) }}"
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

                <!-- Modal Structure -->
                <div id="imageModalPic" class="modalPic">
                    <span class="close-modalPic" id="closeModalPic">
                        &times;
                    </span>
                    <img id="fullImage" src="" alt="Full Image" />
                </div>

                <!-- Modal Structure -->
                <div id="imageModalPic" class="modalPic" style="display: none">
                    <span class="close-modalPic">&times;</span>
                    <img
                        id="fullImage"
                        src=""
                        alt="Full Image"
                        style="width: 50%; height: 50%"
                    />
                </div>

                <td>{{ $account->username }}</td>
                <td>
                    {{ $account->lastName . ', ' . $account->firstName . ', ' . $account->middleName . '.' }}
                </td>
                <td>{{ $account->email }}</td>
                <td>{{ $account->accountType }}</td>
                <td>{{ $account->sex }}</td>
                <td>{{ $account->status }}</td>
                <td>
                    @if ($account->restrict === 'Yes')
                        Yes - {{ $account->restrictDays }} day/s
                    @else
                            No - 0 day/s
                    @endif
                </td>

                <td>{{ $account->created_at }}</td>
                <td>
                    <!--view/edit button-->
                    <button
                        type="button"
                        class="custom-button edit-button"
                        data-id="{{ $account->id }}"
                        data-userPhoto="{{ $account->userPhoto }}"
                        data-user_id="{{ $account->user_id }}"
                        data-username="{{ $account->username }}"
                        data-email="{{ $account->email }}"
                        data-firstName="{{ $account->firstName }}"
                        data-middleName="{{ $account->middleName }}"
                        data-lastName="{{ $account->lastName }}"
                        data-birthDate="{{ $account->birthDate }}"
                        data-nationality="{{ $account->nationality }}"
                        data-sex="{{ $account->sex }}"
                        data-contactNumber="{{ $account->contactNumber }}"
                        data-restrict="{{ $account->restrict }}"
                        data-restrictDays="{{ $account->restrictDays }}"
                        data-accountType="{{ $account->accountType }}"
                    >
                        Edit
                    </button>

                    <!-- Modal Structure (Only one modal for all accounts) -->
                    <div id="editAccountModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeEditModalX">
                                &times;
                            </span>
                            <h2>Edit Account</h2>

                            @include('includes_accounts.edit_inc')
                        </div>
                    </div>

                    <!--delete button-->
                    @include('includes_accounts.delete_inc')
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="paginationContent">
    <ul class="pagination">
        <li
            class="page-item {{ $accounts->currentPage() == 1 ? 'disabled' : '' }}"
            aria-disabled="{{ $accounts->currentPage() == 1 }}"
        >
            <a
                class="page-link"
                href="{{ $accounts->appends(request()->input())->previousPageUrl() }}"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        @for ($i = 1; $i <= $accounts->lastPage(); $i++)
            <li
                class="page-item {{ $accounts->currentPage() == $i ? 'active' : '' }}"
            >
                <a
                    class="page-link"
                    href="{{ $accounts->appends(request()->input())->url($i) }}"
                >
                    {{ $i }}
                </a>
            </li>
        @endfor

        <li
            class="page-item {{ $accounts->hasMorePages() ? '' : 'disabled' }}"
            aria-disabled="{{ ! $accounts->hasMorePages() }}"
        >
            <a
                class="page-link"
                href="{{ $accounts->appends(request()->input())->nextPageUrl() }}"
                rel="next"
            >
                &raquo;
            </a>
        </li>
    </ul>
</div>
