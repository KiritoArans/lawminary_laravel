<form
    id="resourceForm"
    enctype="multipart/form-data"
    method="post"
    action="<?php echo e(route('moderator.uploadResource')); ?>"
>
    <?php echo csrf_field(); ?>
    <?php echo $__env->make('inclusions.response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <label for="documentTitle">Document Title:</label>
    <input
        type="text"
        id="documentTitle"
        name="documentTitle"
        placeholder="Enter Document Name"
        required
    />
    <label for="documentDesc">Document Description:</label>
    <input
        type="text"
        id="documentDesc"
        name="documentDesc"
        placeholder="Enter Description"
        required
    />
    <label for="documentFile">Upload File:</label>
    <input
        class="custom-button"
        type="file"
        id="documentFile"
        name="documentFile"
        accept=".pdf,.doc,.docx,.jpg,.png,.zip"
        required
    />
    <div class="form-buttons">
        <button class="custom-button" type="submit">Add File</button>
    </div>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_resources/add_res_inc.blade.php ENDPATH**/ ?>