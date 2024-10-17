<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<p>*click cell to view data</p>
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Post ID</th>
            <th>Post Photo</th>
            <th>Concern</th>
            <th>Status</th>
            <th>Tags</th>
            <th>Posted By</th>
            <th>Updated By</th>
            <th>Reason for Rejection</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody id="postTableBody">
        <?php if($posts->isEmpty()): ?>
            <tr>
                <td colspan="7">No results found.</td>
            </tr>
        <?php else: ?>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td
                        class="clickable-cell"
                        data-full-text="<?php echo e($activity->post_id); ?>"
                    >
                        <?php echo e(Str::limit($activity->post_id, 10)); ?>

                    </td>
                    <td class="non-clickable">
                        <?php if($activity->concernPhoto): ?>
                            <img
                                src="<?php echo e(Storage::url($activity->concernPhoto)); ?>"
                                alt="Photo"
                                width="50"
                                height="50"
                                class="clickable-photo"
                                data-fullsize="<?php echo e(Storage::url($activity->concernPhoto)); ?>"
                            />
                        <?php else: ?>
                            <img
                                src="<?php echo e(asset('imgs/user-img.png')); ?>"
                                alt="No Photo Available"
                                width="50"
                                height="50"
                                class="clickable-photo"
                                data-fullsize="<?php echo e(asset('imgs/user-img.png')); ?>"
                            />
                        <?php endif; ?>
                    </td>
                    <td
                        class="clickable-cell"
                        data-full-text="<?php echo e($activity->concern); ?>"
                    >
                        <?php echo e(Str::limit($activity->concern, 15)); ?>

                    </td>
                    <td><?php echo e($activity->status); ?></td>
                    <td><?php echo e($activity->tags); ?></td>
                    <td><?php echo e($activity->user->username); ?></td>
                    <td><?php echo e($activity->approvedBy); ?></td>
                    <td
                        class="clickable-cell"
                        data-full-text="<?php echo e($activity->reasonDisregard); ?>"
                    >
                        <?php echo e(Str::limit($activity->reasonDisregard, 20)); ?>

                    </td>
                    <td>
                        <?php echo e(\Carbon\Carbon::parse($activity->updated_at)->format('Y-m-d')); ?>

                    </td>
                    <td class="non-clickable">
                        <button
                            id="btnEditStyle"
                            type="button"
                            class="btn btn-primary editButton"
                            data-id="<?php echo e($activity->id); ?>"
                            data-concern="<?php echo e($activity->concern); ?>"
                            data-status="<?php echo e($activity->status); ?>"
                            data-tags="<?php echo e($activity->tags); ?>"
                            data-postedby="<?php echo e($activity->postedBy); ?>"
                            data-approvedby="<?php echo e($activity->approvedBy); ?>"
                        >
                            Edit
                        </button>

                        <?php echo $__env->make('includes_postpage.post_edit_inc', ['postDelete' => $activity], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </tbody>
</table>

<!-- Modal for showing full content -->
<div id="textModal" class="modal">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="modal-body">
            <p id="fullText"></p>
        </div>
    </div>
</div>

<div class="paginationContent">
    <ul class="pagination">
        <li
            class="page-item <?php echo e($posts->currentPage() == 1 ? 'disabled' : ''); ?>"
            aria-disabled="<?php echo e($posts->currentPage() == 1); ?>"
        >
            <a
                class="page-link"
                href="<?php echo e($posts->appends(request()->input())->previousPageUrl()); ?>"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        <?php for($i = 1; $i <= $posts->lastPage(); $i++): ?>
            <li
                class="page-item <?php echo e($posts->currentPage() == $i ? 'active' : ''); ?>"
            >
                <a
                    class="page-link"
                    href="<?php echo e($posts->appends(request()->input())->url($i)); ?>"
                >
                    <?php echo e($i); ?>

                </a>
            </li>
        <?php endfor; ?>

        <li
            class="page-item <?php echo e($posts->hasMorePages() ? '' : 'disabled'); ?>"
            aria-disabled="<?php echo e(! $posts->hasMorePages()); ?>"
        >
            <a
                class="page-link"
                href="<?php echo e($posts->appends(request()->input())->nextPageUrl()); ?>"
                rel="next"
            >
                &raquo;
            </a>
        </li>
    </ul>
</div>

<div id="viewModal" class="modal">
    <div class="modal-content">
        <span class="close-button" id="closeModal">&times;</span>
        <h2>Activity Details</h2>
        <div id="modalContent">
            <!-- Dynamic content will be loaded here -->
        </div>
    </div>
</div>

<!-- Modal Structure -->
<div id="imageModalPic" class="modalPic" style="display: none">
    <span class="close-modalPic" id="closeModalPic">&times;</span>
    <img
        id="fullImage"
        src=""
        alt="Full Image"
        style="width: 50%; height: 50%"
    />
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_postpage/post_table_inc.blade.php ENDPATH**/ ?>