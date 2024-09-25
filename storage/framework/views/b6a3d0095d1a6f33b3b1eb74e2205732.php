<form
    id="filterForm"
    method="GET"
    action="<?php echo e(request()->is('moderator*') ? route('moderator.filterDashboard') : route('admin.filterDashboard')); ?>"
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

    <label for="filterAction">Action:</label>
    <input
        type="text"
        id="filterAction"
        name="filterAction"
        value="<?php echo e(request('filterAction')); ?>"
    />

    <label for="filterDate">Date:</label>
    <input
        type="date"
        id="filterDate"
        name="filterDate"
        value="<?php echo e(request('filterDate')); ?>"
    />

    <button type="button" class="custom-button" onclick="resetFilter()">
        Reset Filter
    </button>

    <button type="submit" class="custom-button">Apply Filter</button>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_dashboard/dash_filter_inc.blade.php ENDPATH**/ ?>