<div class="search-container"></div>
<form
    action="<?php echo e(request()->is('admin*') ? route('admin.search') : route('moderator.search')); ?>"
    method="GET"
>
    <div class="input-group">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search for activities"
            value="<?php echo e(request('search')); ?>"
        />
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_dashboard/dash_search_inc.blade.php ENDPATH**/ ?>