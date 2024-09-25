<form
    id="addForm"
    method="POST"
    action="<?php echo e(request()->is('moderator*') ? route('moderator.addAccount') : route('admin.addAccount')); ?>"
>
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('inclusions.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

    <label for="nationality">Nationality:</label>
    <select id="nationality" name="nationality" required>
        <option value="">Select Nationality</option>
        <!-- Nationalities will be populated here by JavaScript -->
    </select>

    <label for="sex">Sex:</label>
    <select id="sex" name="sex" required>
        <option value="male" <?php echo e(old('sex') == 'male' ? 'selected' : ''); ?>>
            Male
        </option>
        <option value="female" <?php echo e(old('sex') == 'female' ? 'selected' : ''); ?>>
            Female
        </option>
        <option value="other" <?php echo e(old('sex') == 'other' ? 'selected' : ''); ?>>
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
            value="user"
            <?php echo e(old('accountType') == 'user' ? 'selected' : ''); ?>

        >
            User
        </option>
        <option
            value="moderator"
            <?php echo e(old('accountType') == 'moderator' ? 'selected' : ''); ?>

        >
            Moderator
        </option>
        <option
            value="lawyer"
            <?php echo e(old('accountType') == 'lawyer' ? 'selected' : ''); ?>

        >
            Lawyer
        </option>
        <option
            value="admin"
            <?php echo e(old('accountType') == 'admin' ? 'selected' : ''); ?>

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
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/add_inc.blade.php ENDPATH**/ ?>