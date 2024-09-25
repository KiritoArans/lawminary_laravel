<form
    id="filterForm"
    method="GET"
    action="<?php echo e(route('moderator.filterResources')); ?>"
>
    <label for="filterId">Filter by ID:</label>
    <input
        type="text"
        id="filterId"
        name="filterId"
        value="<?php echo e(request('filterId')); ?>"
    />

    <label for="filterTitle">Filter by Resource Title:</label>
    <input
        type="text"
        id="filterTitle"
        name="filterTitle"
        value="<?php echo e(request('filterTitle')); ?>"
    />

    <label for="filterDesc">Filter by Document:</label>
    <input
        type="text"
        id="filterDesc"
        name="filterDesc"
        value="<?php echo e(request('filterDesc')); ?>"
    />

    <label for="filterDate">Filter by Date Uploaded:</label>
    <input
        type="date"
        id="filterDate"
        name="filterDate"
        value="<?php echo e(request('filterDate')); ?>"
    />

    <button type="button" class="custom-button" onclick="resetFilter()">
        Reset Filter
    </button>

    <button class="custom-button" type="submit">Apply Filters</button>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_resources/filter_res_inc.blade.php ENDPATH**/ ?>