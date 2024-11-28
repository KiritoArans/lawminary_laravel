<form
    id="addForm"
    method="POST"
    action="{{ request()->is('moderator*') ? route('moderator.addAccount') : route('admin.addAccount') }}"
    enctype="multipart/form-data"
>
    @csrf
    @include('inclusions.response')

    <label for="userPhoto">Upload Profile Picture</label>
    <input type="file" name="userPhoto" id="userPhoto" />

    <label for="idPhoto">Upload ID Picture</label>
    <input type="file" name="idPhoto" id="idPhoto" />

    <label for="firstName">First Name:</label>
    <input
        type="text"
        id="firstName"
        name="firstName"
        value="{{ old('firstName') }}"
        required
    />

    <label for="middleName">Middle Name (optional):</label>
    <input
        type="text"
        id="middleName"
        name="middleName"
        value="{{ old('middleName') }}"
    />

    <label for="lastName">Last Name:</label>
    <input
        type="text"
        id="lastName"
        name="lastName"
        value="{{ old('lastName') }}"
        required
    />

    <label for="address">Adress</label>
    <select id="address" name="barangay" required>
        <option value="">Option</option>
        @foreach (['Tanauan', 'Malvar', 'Sto. Tomas', 'Balete', 'Talisay', 'Laurel']
            as $barangay)
            <option
                value="{{ $barangay }}"
                {{ old('barangay') == $barangay ? 'selected' : '' }}
            >
                {{ $barangay }}
            </option>
        @endforeach
    </select>

    <label for="birthDate">Birth Date:</label>
    <input
        type="date"
        id="birthDate"
        name="birthDate"
        value="{{ old('birthDate') }}"
        required
    />
    <div id="birthDateError" style="color: red"></div>
    <!-- Error message placeholder -->

    <label for="sex">Sex:</label>
    <select id="sex" name="sex" required>
        <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>
            Male
        </option>
        <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>
            Female
        </option>
        <option value="Other" {{ old('sex') == 'Other' ? 'selected' : '' }}>
            Other
        </option>
    </select>

    <label for="email">Email:</label>
    <input
        type="email"
        id="email"
        name="email"
        value="{{ old('email') }}"
        required
    />
    <div id="emailError" style="color: red"></div>
    <!-- Error message placeholder -->

    <label for="username">Username:</label>
    <input
        type="text"
        id="username"
        name="username"
        value="{{ old('username') }}"
        required
    />

    <label for="accountType">Account Type:</label>
    <select id="accountType" name="accountType" required>
        <option
            value="User"
            {{ old('accountType') == 'User' ? 'selected' : '' }}
        >
            User
        </option>
        <option
            value="Moderator"
            {{ old('accountType') == 'Moderator' ? 'selected' : '' }}
        >
            Moderator
        </option>
        <option
            value="Lawyer"
            {{ old('accountType') == 'Lawyer' ? 'selected' : '' }}
        >
            Lawyer
        </option>
        <option
            value="Admin"
            {{ old('accountType') == 'Admin' ? 'selected' : '' }}
        >
            Admin
        </option>
    </select>

    <!-- Password Field -->
    <label for="password">Password:</label>
    <div class="password-container">
        <input type="password" id="password" name="password" required />
        <span class="toggle-password" onclick="togglePassword('password')">
            <i class="fa fa-eye" id="password-eye"></i>
        </span>
    </div>

    <!-- Confirm Password Field -->
    <label for="password_confirmation">Confirm Password:</label>
    <div class="password-container">
        <input
            type="password"
            id="password_confirmation"
            name="password_confirmation"
            required
        />
        <span
            class="toggle-password"
            onclick="togglePassword('password_confirmation')"
        >
            <i class="fa fa-eye" id="password_confirmation-eye"></i>
        </span>
    </div>
    <div id="passwordError" style="color: red"></div>
    <!-- Error message placeholder -->

    <button type="submit" class="custom-button">Add Account</button>
</form>
