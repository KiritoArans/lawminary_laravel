<form
    id="editAccountForm"
    method="POST"
    action="{{ strpos(request()->path(), 'admin') !== false ? route('admin.updateAccount', $account->id) : route('moderator.updateAccount', $account->id) }}"
    enctype="multipart/form-data"
>
    @csrf
    @method('PUT')
    @include('inclusions.response')

    <input type="hidden" id="editId" name="id" value="" />

    <label for="userPhoto">Upload Profile Picture</label>
    <input type="file" name="userPhoto" id="userPhoto" />

    <label for="editUsername">Username</label>
    <input type="text" id="editUsername" name="username" required value="" />

    <label for="editEmail">Email</label>
    <input type="email" id="editEmail" name="email" required value="" />

    {{--
        <label for="editPassword">Password</label>
        <input type="password" id="editPassword" name="password" value="">
    --}}

    <label for="editFirstName">First Name</label>
    <input type="text" id="editFirstName" name="firstName" required value="" />

    <label for="editMiddleName">Middle Name (optional)</label>
    <input type="text" id="editMiddleName" name="middleName" value="" />

    <label for="editLastName">Last Name</label>
    <input type="text" id="editLastName" name="lastName" required value="" />

    <label for="editBirthDate">Birth Date</label>
    <input type="date" id="editBirthDate" name="birthDate" required value="" />

    <label for="editNationality">Nationality</label>
    <input
        type="text"
        id="editNationality"
        name="nationality"
        required
        value=""
    />

    <label for="editSex">Sex</label>
    <select id="editSex" name="sex" value="">
        <option value="Male" {{ $account->sex == 'Male' ? 'selected' : '' }}>
            Male
        </option>
        <option
            value="Female"
            {{ $account->sex == 'Female' ? 'selected' : '' }}
        >
            Female
        </option>
        <option value="Other" {{ $account->sex == 'Other' ? 'selected' : '' }}>
            Other
        </option>
    </select>

    <label for="editContactNumber">Contact Number</label>
    <input
        type="text"
        id="editContactNumber"
        name="contactNumber"
        required
        value=""
    />

    <label for="editRestrict">Restrict</label>
    <select id="editRestrict" name="restrict" value="">
        <option
            value="Yes"
            {{ $account->editRestrict == 'Yes' ? 'selected' : '' }}
        >
            Yes
        </option>
        <option
            value="No"
            {{ $account->editRestrict == 'No' ? 'selected' : '' }}
        >
            No
        </option>
    </select>

    <label for="editRestrictDays">Restrict Days</label>
    <input
        type="number"
        id="editRestrictDays"
        name="restrictDays"
        value="{{ $account->restrictDays }}"
        {{ ! $account->restrict ? 'disabled' : '' }}
    />

    <label for="editAccountType">Account Type</label>
    <select id="editAccountType" name="accountType" value="">
        <option
            value="User"
            {{ $account->accountType == 'User' ? 'selected' : '' }}
        >
            User
        </option>
        <option
            value="Lawyer"
            {{ $account->accountType == 'Lawyer' ? 'selected' : '' }}
        >
            Lawyer
        </option>
        <option
            value="Admin"
            {{ $account->accountType == 'Admin' ? 'selected' : '' }}
        >
            Admin
        </option>
        <option
            value="Moderator"
            {{ $account->accountType == 'Moderator' ? 'selected' : '' }}
        >
            Moderator
        </option>
    </select>

    <button type="submit" class="custom-button">Save Changes</button>
</form>

<form
    id="delete-form-{{ $account->id }}"
    method="POST"
    style="display: inline"
    action="{{ request()->is('moderator*') ? route('moderator.destroyAccount', $account->id) : route('admin.destroyAccount', $account->id) }}"
>
    @csrf
    @method('DELETE')
    @include('inclusions.response')
    <button
        type="button"
        class="delete-button"
        onclick="confirmDelete({{ $account->id }})"
    >
        Delete
    </button>
</form>
