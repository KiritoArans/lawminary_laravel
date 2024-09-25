<form
    action="<?php echo e(request()->is('admin*') ? route('admin.searchAccounts') : route('moderator.searchAccounts')); ?>"
    method="GET"
>
    <div class="search-bar-content">
        <div class="search-bar">
            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search Accounts..."
                value="<?php echo e(request('search')); ?>"
            />
        </div>
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/search_inc.blade.php ENDPATH**/ ?>