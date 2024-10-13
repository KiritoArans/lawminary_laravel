<?php if($sysconData->isNotEmpty() && $sysconData->first()->about_lawminary): ?>
    <div class="about-lawminary">
        <?php $__currentLoopData = preg_split('/(\r?\n)+/', $sysconData->first()->about_lawminary); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <p><?php echo trim($paragraph); ?></p>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php else: ?>
    <p>No information about Lawminary available.</p>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_syscon/about_lawminary_inc.blade.php ENDPATH**/ ?>