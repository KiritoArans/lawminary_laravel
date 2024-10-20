<form
    id="addForm"
    method="POST"
    action="<?php echo e(request()->is('moderator*') ? route('moderator.addAccount') : route('admin.addAccount')); ?>"
    enctype="multipart/form-data"
>
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('inclusions.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <label for="userPhoto">Upload Profile Picture</label>
    <input type="file" name="userPhoto" id="userPhoto" />

    <label for="firstName">First Name:</label>
    <input
        type="text"
        id="firstName"
        name="firstName"
        value="<?php echo e(old('firstName')); ?>"
        required
    />

    <label for="middleName">Middle Name (optional):</label>
    <input
        type="text"
        id="middleName"
        name="middleName"
        value="<?php echo e(old('middleName')); ?>"
    />

    <label for="lastName">Last Name:</label>
    <input
        type="text"
        id="lastName"
        name="lastName"
        value="<?php echo e(old('lastName')); ?>"
        required
    />

    <label for="birthDate">Birth Date:</label>
    <input
        type="date"
        id="birthDate"
        name="birthDate"
        value="<?php echo e(old('birthDate')); ?>"
        required
    />
    <div id="birthDateError" style="color: red"></div>
    <!-- Error message placeholder -->

    <label for="nationality">Nationality:</label>
    <select id="nationality" name="nationality" required>
        <option value="">Select Nationality</option>
        <!-- Nationalities will be populated here by JavaScript sssssss-->
    </select>

    <label for="sex">Sex:</label>
    <select id="sex" name="sex" required>
        <option value="Male" <?php echo e(old('sex') == 'Male' ? 'selected' : ''); ?>>
            Male
        </option>
        <option value="Female" <?php echo e(old('sex') == 'Female' ? 'selected' : ''); ?>>
            Female
        </option>
        <option value="Other" <?php echo e(old('sex') == 'Other' ? 'selected' : ''); ?>>
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
            value="<?php echo e(old('contactNumber')); ?>"
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
        value="<?php echo e(old('email')); ?>"
        required
    />
    <div id="emailError" style="color: red"></div>
    <!-- Error message placeholder -->

    <label for="username">Username:</label>
    <input
        type="text"
        id="username"
        name="username"
        value="<?php echo e(old('username')); ?>"
        required
    />

    <label for="accountType">Account Type:</label>
    <select id="accountType" name="accountType" required>
        <option
            value="User"
            <?php echo e(old('accountType') == 'User' ? 'selected' : ''); ?>

        >
            User
        </option>
        <option
            value="Moderator"
            <?php echo e(old('accountType') == 'Moderator' ? 'selected' : ''); ?>

        >
            Moderator
        </option>
        <option
            value="Lawyer"
            <?php echo e(old('accountType') == 'Lawyer' ? 'selected' : ''); ?>

        >
            Lawyer
        </option>
        <option
            value="Admin"
            <?php echo e(old('accountType') == 'Admin' ? 'selected' : ''); ?>

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
    <div id="passwordError" style="color: red"></div>
    <!-- Error message placeholder -->

    <button type="submit" class="custom-button">Add Account</button>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/add_inc.blade.php ENDPATH**/ ?>