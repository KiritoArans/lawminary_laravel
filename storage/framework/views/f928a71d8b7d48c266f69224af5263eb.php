<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Forums</h1>

    <!-- Search Form -->
    <form action="<?php echo e(route('admin.forums')); ?>" method="GET">
        <div class="input-group mb-3">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search for forums..."
                value="<?php echo e(request('search')); ?>"
            />
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Existing table and content -->
    <!-- ... -->
</div>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_forums/forums_search_inc.blade.php ENDPATH**/ ?>