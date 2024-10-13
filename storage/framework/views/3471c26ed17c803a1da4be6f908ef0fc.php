<form
    action="<?php echo e(request()->is('admin*') ? route('admin.searchAccounts') : route('moderator.searchAccounts')); ?>"
    method="GET"
>
    <div class="input-group">
        <input
            type="text"
            name="search"
            class="form-control"
            placeholder="Search Accounts..."
            value="<?php echo e(request('search')); ?>"
        />
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/search_inc.blade.php ENDPATH**/ ?>