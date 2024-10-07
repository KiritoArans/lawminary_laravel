<form
    id="addForm"
    method="POST"
    action="{{ request()->is('moderator*') ? route('moderator.addAccount') : route('admin.addAccount') }}"
>
    @csrf
    @include('inclusions.response')

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

    <label for="birthDate">Birth Date:</label>
    <input
        type="date"
        id="birthDate"
        name="birthDate"
        value="{{ old('birthDate') }}"
        required
    />

    <label for="nationality">Nationality:</label>
    <select id="nationality" name="nationality" required>
        <option value="">Select Nationality</option>
        <!-- Nationalities will be populated here by JavaScript -->
    </select>

    <label for="sex">Sex:</label>
    <select id="sex" name="sex" required>
        <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>
            Male
        </option>
        <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>
            Female
        </option>
        <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>
            Other
        </option>
    </select>

    <label for="contactNumber">Contact Number:</label>
    <div>
        <span>+63</span>
        <input
            type="tel"
            id="contactNumber"
            name="contactNumber"
            maxlength="10"
            value="{{ old('contactNumber') }}"
            placeholder="Enter phone number"
            pattern="[0-9]{10}"
            required
        />
    </div>

    <label for="email">Email:</label>
    <input
        type="email"
        id="email"
        name="email"
        value="{{ old('email') }}"
        required
    />

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

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required />

    <label for="password_confirmation">Confirm Password</label>
    <input
        type="password"
        id="password_confirmation"
        name="password_confirmation"
        required
    />

    <button type="submit" class="custom-button">Add Account</button>
</form>
