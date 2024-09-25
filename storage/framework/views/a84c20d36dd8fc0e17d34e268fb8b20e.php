<div class="search-bar-content">
    <form
        action="<?php echo e(route('moderator.searchLeaderboards')); ?>"
        method="GET"
        class="search-bar"
    >
        <input
            type="text"
            id="searchInput"
            name="query"
            placeholder="Search Leaderboards..."
            value="<?php echo e(request()->query('query')); ?>"
        />
        <button type="submit" class="custom-button">Search</button>
    </form>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_leaderboards/search_led_inc.blade.php ENDPATH**/ ?>