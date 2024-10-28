<table class="table table-striped table-bordered">
    <p>*click cell to view data</p>
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
            <th>Restriction Days</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody id="accountTableBody">
        @foreach ($accounts as $account)
            <tr>
                <td class="clickable-cell" data-full-text="{{ $account->id }}">
                    {{ Str::limit($account->id, 10) }}
                </td>
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
                <div id="imageModalPic" class="modalPic" style="display: none">
                    <span class="close-modalPic" id="closeModalPic">
                        &times;
                    </span>
                    <img
                        id="fullImage"
                        src=""
                        alt="Full Image"
                        style="width: 50%; height: 50%"
                    />
                </div>

                <td
                    class="clickable-cell"
                    data-full-text="{{ $account->username }}"
                >
                    {{ Str::limit($account->username, 15) }}
                </td>
                <td
                    class="clickable-cell"
                    data-full-text="{{ $account->lastName . ', ' . $account->firstName . ', ' . $account->middleName . '.' }}"
                >
                    {{ Str::limit($account->lastName . ', ' . $account->firstName . ', ' . $account->middleName . '.', 20) }}
                </td>
                <td
                    class="clickable-cell"
                    data-full-text="{{ $account->email }}"
                >
                    {{ Str::limit($account->email, 25) }}
                </td>
                <td
                    class="clickable-cell"
                    data-full-text="{{ $account->accountType }}"
                >
                    {{ Str::limit($account->accountType, 15) }}
                </td>
                <td
                    class="clickable-cell"
                    data-full-text="{{ $account->sex }}"
                >
                    {{ Str::limit($account->sex, 10) }}
                </td>
                <td
                    class="clickable-cell"
                    data-full-text="{{ $account->status }}"
                >
                    {{ Str::limit($account->status, 10) }}
                </td>
                <td
                    class="clickable-cell"
                    data-full-text="{{ optional($account->restrictedUser)->restrict_days ? optional($account->restrictedUser)->restrict_days . ' day/s' : 'No - 0 day/s' }}"
                >
                    @if ($account->restrictedUser)
                        {{ Str::limit($account->restrictedUser->restrict_days . ' day/s', 15) }}
                    @else
                            No - 0 day/s
                    @endif
                </td>

                <td
                    class="clickable-cell"
                    data-full-text="{{ $account->created_at }}"
                >
                    {{ Str::limit($account->created_at, 10) }}
                </td>

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
                        data-sex="{{ $account->sex }}"
                        data-restrictdays="{{ $account->restrictedUser->restrict_days ?? '' }}"
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

                            @include('includes_accounts.edit_inc')
                        </div>
                    </div>

                    <!--delete button-->
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal for full text -->
<div id="textModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="modal-body">
            <p id="fullText"></p>
        </div>
    </div>
</div>

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
