<?php if($sysconData->isNotEmpty() && $sysconData->first()->about_pao): ?>
    <div class="about-pao">
        <?php $__currentLoopData = preg_split('/(\r?\n)+/', $sysconData->first()->about_pao); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo trim($paragraph); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <p>No information about PAO available.</p>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_syscon/about_pao_inc.blade.php ENDPATH**/ ?>