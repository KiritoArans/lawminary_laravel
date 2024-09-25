<div class="search-bar-content">
    <form
        action="<?php echo e(route('moderator.searchResources')); ?>"
        method="GET"
        class="search-bar"
    >
        <input
            type="text"
            id="searchInput"
            name="query"
            placeholder="Search resources..."
            value="<?php echo e(request()->query('query')); ?>"
        />
        <button type="submit" class="custom-button">Search</button>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_resources/search_res_inc.blade.php ENDPATH**/ ?>