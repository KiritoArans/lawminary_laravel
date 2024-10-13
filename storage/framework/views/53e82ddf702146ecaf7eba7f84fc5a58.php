<button
    type="button"
    class="btn-view-reject"
    data-target="#disregardModal-<?php echo e($post->post_id); ?>"
    name="reject"
>
    <img
        src="<?php echo e(asset('imgs/buttons/reject.png')); ?>"
        alt="Approve Button"
        width="35"
    />
</button>

<!-- Disregard Modal -->
<div
    class="modal fade"
    id="disregardModal-<?php echo e($post->post_id); ?>"
    tabindex="-1"
    role="dialog"
    aria-labelledby="disregardModalLabel"
>
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="close-button-reason" id="closeModal">&times;</div>

            <div class="modal-header">
                <h5 class="modal-title" id="disregardModalLabel">
                    Provide reason for rejection
                </h5>
            </div>
            <div class="modal-body">
                <form
                    method="POST"
                    action="<?php echo e(route('admin.postpage', $post->post_id)); ?>"
                >
                    <?php echo csrf_field(); ?>
                    <input
                        type="hidden"
                        name="post_id"
                        value="<?php echo e($post->post_id); ?>"
                    />
                    <div class="form-group">
                        <textarea
                            class="form-control"
                            name="reasonDisregard"
                            id="reasonDisregard-<?php echo e($post->post_id); ?>"
                            required
                        ></textarea>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="submit"
                            class="custom-button"
                            name="reject"
                        >
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_postpage/post_reject_inc.blade.php ENDPATH**/ ?>