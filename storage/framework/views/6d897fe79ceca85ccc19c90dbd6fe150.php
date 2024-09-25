<!-- resources/views/includes/logo.blade.php -->

<?php if($sysconData->isNotEmpty() && $sysconData->first()->logo_path): ?>
    <img src="<?php echo e($sysconData->first()->logo_path ? Storage::url($sysconData->first()->logo_path) : asset('imgs/Lawminary_Logo_2-Gold.png')); ?>" alt="Logo" />
<?php else: ?>
    <img src="../imgs/Lawminary_Logo_2-Gold.png" alt="">
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_syscon/syscon_logo_inc.blade.php ENDPATH**/ ?>