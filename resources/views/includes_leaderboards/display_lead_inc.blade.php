<table class="table table-striped">
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
                <td>{{ $leaderboard->lawyerUser_id }}</td>
                <td>{{ $leaderboard->username }}</td>
                <td>{{ $leaderboard->rankPoints }}</td>
                <td class="rank">
                    <!-- Display rank as an image -->

                    @if ($leaderboard->rank === 'Wood')
                        <img
                            src="{{ asset('imgs/badges/wood.png') }}"
                            alt="Wood Badge"
                            width="50"
                        />
                    @elseif ($leaderboard->rank === 'Steel')
                        <img
                            src="{{ asset('imgs/badges/steel.png') }}"
                            alt="Steel Badge"
                            width="50"
                        />
                    @elseif ($leaderboard->rank === 'Bronze')
                        <img
                            src="{{ asset('imgs/badges/bronze.png') }}"
                            alt="Bronze Badge"
                            width="50"
                        />
                    @elseif ($leaderboard->rank === 'Silver')
                        <img
                            src="{{ asset('imgs/badges/silver.png') }}"
                            alt="Silver Badge"
                            width="50"
                        />
                    @elseif ($leaderboard->rank === 'Gold')
                        <img
                            src="{{ asset('imgs/badges/gold.png') }}"
                            alt="Gold Badge"
                            width="50"
                        />
                    @elseif ($leaderboard->rank === 'Diamond')
                        <img
                            src="{{ asset('imgs/badges/diamond.png') }}"
                            alt="Diamond Badge"
                            width="50"
                        />
                    @endif
                </td>
                <td>{{ $loop->iteration }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
