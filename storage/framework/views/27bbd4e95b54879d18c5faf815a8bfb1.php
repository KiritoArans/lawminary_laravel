<?php if($sysconData->isNotEmpty() && $sysconData->first()->terms_of_service): ?>
    <div class="terms-of-service">
        <?php $__currentLoopData = preg_split('/(\r?\n)+/', $sysconData->first()->terms_of_service); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo trim($paragraph); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <p>No terms of service available.</p>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_syscon/about_tos_inc.blade.php ENDPATH**/ ?>