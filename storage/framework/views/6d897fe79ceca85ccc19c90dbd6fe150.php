<!-- resources/views/includes/logo.blade.php -->
<?php if($sysconData->isNotEmpty() && !empty($sysconData->first()->logo_path)): ?>
    <a href="/home">
        <img src="<?php echo e(Storage::url($sysconData->first()->logo_path)); ?>" alt="Logo" />
    </a>
<?php else: ?>
    <a href="/home">
        <img src="<?php echo e(asset('../imgs/Lawminary_Logo_2-Gold.png')); ?>" alt="Logo">
    </a>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_syscon/syscon_logo_inc.blade.php ENDPATH**/ ?>