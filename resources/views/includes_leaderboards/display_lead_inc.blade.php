<table class="table table-striped table-bordered">
    <p>*click cell to view data</p>
    <thead>
        <tr>
            <th>Lawyer ID</th>
            <th>Username</th>
            <th>Total Points</th>
            <th>Rank</th>
            <th>Position</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($leaderboards as $leaderboard)
            <tr>
                <td
                    class="clickable-cell"
                    data-full-text="{{ $leaderboard->lawyerUser_id }}"
                >
                    {{ Str::limit($leaderboard->lawyerUser_id, 10) }}
                </td>
                <td
                    class="clickable-cell"
                    data-full-text="{{ $leaderboard->username }}"
                >
                    {{ Str::limit($leaderboard->username, 15) }}
                </td>
                <td
                    class="clickable-cell"
                    data-full-text="{{ $leaderboard->rankPoints }}"
                >
                    {{ Str::limit($leaderboard->rankPoints, 10) }}
                </td>
                <td class="rank">
                    <!-- Clickable image that opens in a modal -->

                    @if ($leaderboard->rank === 'Wood')
                        <img
                            src="{{ asset('imgs/badges/wood.png') }}"
                            alt="Wood Badge"
                            class="clickable-photo"
                            width="50"
                            data-fullsize="{{ asset('imgs/badges/wood.png') }}"
                        />
                    @elseif ($leaderboard->rank === 'Steel')
                        <img
                            src="{{ asset('imgs/badges/steel.png') }}"
                            alt="Steel Badge"
                            class="clickable-photo"
                            width="50"
                            data-fullsize="{{ asset('imgs/badges/steel.png') }}"
                        />
                    @elseif ($leaderboard->rank === 'Bronze')
                        <img
                            src="{{ asset('imgs/badges/bronze.png') }}"
                            alt="Bronze Badge"
                            class="clickable-photo"
                            width="50"
                            data-fullsize="{{ asset('imgs/badges/bronze.png') }}"
                        />
                    @elseif ($leaderboard->rank === 'Silver')
                        <img
                            src="{{ asset('imgs/badges/silver.png') }}"
                            alt="Silver Badge"
                            class="clickable-photo"
                            width="50"
                            data-fullsize="{{ asset('imgs/badges/silver.png') }}"
                        />
                    @elseif ($leaderboard->rank === 'Gold')
                        <img
                            src="{{ asset('imgs/badges/gold.png') }}"
                            alt="Gold Badge"
                            class="clickable-photo"
                            width="50"
                            data-fullsize="{{ asset('imgs/badges/gold.png') }}"
                        />
                    @elseif ($leaderboard->rank === 'Diamond')
                        <img
                            src="{{ asset('imgs/badges/diamond.png') }}"
                            alt="Diamond Badge"
                            class="clickable-photo"
                            width="50"
                            data-fullsize="{{ asset('imgs/badges/diamond.png') }}"
                        />
                    @endif
                </td>
                <td
                    class="clickable-cell"
                    data-full-text="{{ $loop->iteration }}"
                >
                    {{ $loop->iteration }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal for showing cell data -->
<div id="textModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <p id="fullText"></p>
        <!-- Full text content will be injected here -->
    </div>
</div>

<!-- Modal for showing full-size image -->
<div id="imageModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <img id="fullImage" src="" alt="Full Size Image" style="width: 100%" />
    </div>
</div>

<div class="paginationContent">
    <ul class="pagination">
        <li
            class="page-item {{ $leaderboards->currentPage() == 1 ? 'disabled' : '' }}"
            aria-disabled="{{ $leaderboards->currentPage() == 1 }}"
        >
            <a
                class="page-link"
                href="{{ $leaderboards->appends(request()->input())->previousPageUrl() }}"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        @for ($i = 1; $i <= $leaderboards->lastPage(); $i++)
            <li
                class="page-item {{ $leaderboards->currentPage() == $i ? 'active' : '' }}"
            >
                <a
                    class="page-link"
                    href="{{ $leaderboards->appends(request()->input())->url($i) }}"
                >
                    {{ $i }}
                </a>
            </li>
        @endfor

        <li
            class="page-item {{ $leaderboards->hasMorePages() ? '' : 'disabled' }}"
            aria-disabled="{{ ! $leaderboards->hasMorePages() }}"
        >
            <a
                class="page-link"
                href="{{ $leaderboards->appends(request()->input())->nextPageUrl() }}"
                rel="next"
            >
                &raquo;
            </a>
        </li>
    </ul>
</div>
