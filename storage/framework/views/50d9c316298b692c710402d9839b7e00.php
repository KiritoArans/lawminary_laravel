<?php if(session('success')): ?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '<?php echo e(session('success')); ?>',
        showConfirmButton: false,
        timer: 2000
    });
</script>
<?php endif; ?>

<?php if(session('error')): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '<?php echo e(session('error')); ?>',
        showConfirmButton: true
    });
</script>
<?php endif; ?>

<?php if($errors->any()): ?>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Submission Error',
        html: '<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span><?php echo e($error); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>',
        showConfirmButton: true
    });
</script>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/inclusions/response.blade.php ENDPATH**/ ?>