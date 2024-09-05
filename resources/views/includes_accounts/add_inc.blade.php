<form id="addForm" method="POST" action="{{ request()->is('moderator*') ? route('moderator.addAccount') : route('admin.addAccount') }}">
    @csrf
    @include('inclusions.response')
<label for="firstName">First Name:</label>
<input type="text" id="firstName" name="firstName" value="{{ old('firstName') }}" required>

<label for="middleName">Middle Name (optional): </label>
<input type="text" id="middleName" name="middleName" value="{{ old('middleName') }}">

<label for="lastName">Last Name:</label>
<input type="text" id="lastName" name="lastName" value="{{ old('lastName') }}" required>

<label for="birthDate">Birth Date:</label>
<input type="date" id="birthDate" name="birthDate" value="{{ old('birthDate') }}" required>

<label for="nationality">Nationality:</label>
<input type="text" id="nationality" name="nationality" value="{{ old('nationality') }}" required>

<label for="sex">Sex:</label>
<select id="sex" name="sex" required>
    <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>Male</option>
    <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>Female</option>
    <option value="other" {{ old('sex') == 'other' ? 'selected' : '' }}>Other</option>
</select>

<label for="contactNumber">Contact Number:</label>
<input type="tel" id="contactNumber" name="contactNumber" value="{{ old('contactNumber') }}" required>

<label for="email">Email:</label>
<input type="email" id="email" name="email" value="{{ old('email') }}" required>

<label for="username">Username:</label>
<input type="text" id="username" name="username" value="{{ old('username') }}" required>

<label for="accountType">Account Type:</label>
<select id="accountType" name="accountType" required>
    <option value="user" {{ old('accountType') == 'user' ? 'selected' : '' }}>User</option>
    <option value="moderator" {{ old('accountType') == 'moderator' ? 'selected' : '' }}>Moderator</option>
    <option value="lawyer" {{ old('accountType') == 'lawyer' ? 'selected' : '' }}>Lawyer</option>
    <option value="admin" {{ old('accountType') == 'admin' ? 'selected' : '' }}>Admin</option>
</select>

<label for="password">Password:</label>
<input type="password" id="password" name="password" required>

<label for="password_confirmation">Confirm Password</label>
<input type="password" id="password_confirmation" name="password_confirmation" required>

<button type="submit" class="custom-button">Add Account</button>
</form>