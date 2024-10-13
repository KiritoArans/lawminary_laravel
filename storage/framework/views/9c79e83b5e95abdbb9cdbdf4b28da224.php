<form
    id="filterForm"
    method="GET"
    action="<?php echo e(request()->is('moderator*') ? route('moderator.filterAccount') : route('admin.filterAccount')); ?>"
>
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('inclusions.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <label for="filterId">ID:</label>
    <input
        type="text"
        id="filterId"
        name="filterId"
        value="<?php echo e(request('filterId')); ?>"
    />

    <label for="filterUsername">Username:</label>
    <input
        type="text"
        id="filterUsername"
        name="filterUsername"
        value="<?php echo e(request('filterUsername')); ?>"
    />

    <label for="filterEmail">Email:</label>
    <input
        type="text"
        id="filterEmail"
        name="filterEmail"
        value="<?php echo e(request('filterEmail')); ?>"
    />

    <label for="filterAccountType">Account Type:</label>

    <select id="accountType" name="accountType">
        <option
            value="all"
            <?php echo e(request('accountType') == 'all' ? 'selected' : ''); ?>

        >
            View All
        </option>
        <option
            value="Moderator"
            <?php echo e(request('accountType') == 'Moderator' ? 'selected' : ''); ?>

        >
            Moderator
        </option>
        <option
            value="User"
            <?php echo e(request('accountType') == 'User' ? 'selected' : ''); ?>

        >
            User
        </option>
        <option
            value="Lawyer"
            <?php echo e(request('accountType') == 'Lawyer' ? 'selected' : ''); ?>

        >
            Lawyer
        </option>
        <option
            value="Admin"
            <?php echo e(request('accountType') == 'Admin' ? 'selected' : ''); ?>

        >
            Admin
        </option>
    </select>

    <button type="button" class="custom-button" onclick="resetFilter()">
        Reset Filter
    </button>

    <button type="submit" class="custom-button">Apply Filter</button>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/filter_inc.blade.php ENDPATH**/ ?>