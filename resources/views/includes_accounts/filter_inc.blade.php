<form
    id="filterForm"
    method="GET"
    action="{{ request()->is('moderator*') ? route('moderator.filterAccount') : route('admin.filterAccount') }}"
>
    @csrf
    @include('inclusions.response')

    <label for="filterId">ID:</label>
    <input
        type="text"
        id="filterId"
        name="filterId"
        value="{{ request('filterId') }}"
    />

    <label for="filterUsername">Username:</label>
    <input
        type="text"
        id="filterUsername"
        name="filterUsername"
        value="{{ request('filterUsername') }}"
    />

    <label for="filterEmail">Email:</label>
    <input
        type="text"
        id="filterEmail"
        name="filterEmail"
        value="{{ request('filterEmail') }}"
    />

    <label for="filterAccountType">Account Type:</label>

    <select id="accountType" name="accountType">
        <option
            value="all"
            {{ request('accountType') == 'all' ? 'selected' : '' }}
        >
            View All
        </option>
        <option
            value="Moderator"
            {{ request('accountType') == 'Moderator' ? 'selected' : '' }}
        >
            Moderator
        </option>
        <option
            value="User"
            {{ request('accountType') == 'User' ? 'selected' : '' }}
        >
            User
        </option>
        <option
            value="Lawyer"
            {{ request('accountType') == 'Lawyer' ? 'selected' : '' }}
        >
            Lawyer
        </option>
        <option
            value="Admin"
            {{ request('accountType') == 'Admin' ? 'selected' : '' }}
        >
            Admin
        </option>
    </select>

    <button type="button" class="custom-button" onclick="resetFilter()">
        Reset Filter
    </button>

    <button type="submit" class="custom-button">Apply Filter</button>
</form>
