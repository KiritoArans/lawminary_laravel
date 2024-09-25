<form
    id="delete-form-<?php echo e($account->id); ?>"
    method="POST"
    style="display: inline"
    action="<?php echo e(request()->is('moderator*') ? route('moderator.destroyAccount', $account->id) : route('admin.destroyAccount', $account->id)); ?>"
>
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <?php echo $__env->make('inclusions.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <button
        type="button"
        class="delete-button"
        data-account-id="<?php echo e($account->id); ?>"
    >
        Delete
    </button>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/delete_inc.blade.php ENDPATH**/ ?>