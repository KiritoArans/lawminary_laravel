<table class="table table-striped table-bordered">
    <p>*click cell to view data</p>
    <thead>
        <tr>
            <th>ID</th>
            <th>Display Photo</th>
            <th>Username</th>
            <th>LN, FN, MI</th>
            <th>E-mail</th>
            <th>Account Type</th>
            <th>Sex</th>
            <th>status</th>
            <th>Restrict | Restrict Days</th>
            <th>Date Created</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody id="accountTableBody">
        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td class="clickable-cell" data-full-text="<?php echo e($account->id); ?>">
                    <?php echo e(Str::limit($account->id, 10)); ?>

                </td>
                <td>
                    <?php if($account->userPhoto): ?>
                        <img
                            src="<?php echo e(Storage::url($account->userPhoto)); ?>"
                            alt="User Photo"
                            width="50"
                            height="50"
                            class="clickable-photo"
                            data-fullsize="<?php echo e(Storage::url($account->userPhoto)); ?>"
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

                <!-- Modal Structure -->
                <div id="imageModalPic" class="modalPic" style="display: none">
                    <span class="close-modalPic" id="closeModalPic">
                        &times;
                    </span>
                    <img
                        id="fullImage"
                        src=""
                        alt="Full Image"
                        style="width: 50%; height: 50%"
                    />
                </div>

                <td
                    class="clickable-cell"
                    data-full-text="<?php echo e($account->username); ?>"
                >
                    <?php echo e(Str::limit($account->username, 15)); ?>

                </td>
                <td
                    class="clickable-cell"
                    data-full-text="<?php echo e($account->lastName . ', ' . $account->firstName . ', ' . $account->middleName . '.'); ?>"
                >
                    <?php echo e(Str::limit($account->lastName . ', ' . $account->firstName . ', ' . $account->middleName . '.', 20)); ?>

                </td>
                <td
                    class="clickable-cell"
                    data-full-text="<?php echo e($account->email); ?>"
                >
                    <?php echo e(Str::limit($account->email, 25)); ?>

                </td>
                <td
                    class="clickable-cell"
                    data-full-text="<?php echo e($account->accountType); ?>"
                >
                    <?php echo e(Str::limit($account->accountType, 15)); ?>

                </td>
                <td
                    class="clickable-cell"
                    data-full-text="<?php echo e($account->sex); ?>"
                >
                    <?php echo e(Str::limit($account->sex, 10)); ?>

                </td>
                <td
                    class="clickable-cell"
                    data-full-text="<?php echo e($account->status); ?>"
                >
                    <?php echo e(Str::limit($account->status, 10)); ?>

                </td>
                <td
                    class="clickable-cell"
                    data-full-text="<?php if($account->restrict === 'Yes'): ?> Yes - <?php echo e($account->restrictDays); ?> day/s <?php else: ?> No - 0 day/s <?php endif; ?>"
                >
                    <?php echo e(Str::limit($account->restrict === 'Yes' ? 'Yes - ' . $account->restrictDays . ' day/s' : 'No - 0 day/s', 15)); ?>

                </td>
                <td
                    class="clickable-cell"
                    data-full-text="<?php echo e($account->created_at); ?>"
                >
                    <?php echo e(Str::limit($account->created_at, 10)); ?>

                </td>

                <td>
                    <!--view/edit button-->
                    <button
                        type="button"
                        class="custom-button edit-button"
                        data-id="<?php echo e($account->id); ?>"
                        data-userPhoto="<?php echo e($account->userPhoto); ?>"
                        data-user_id="<?php echo e($account->user_id); ?>"
                        data-username="<?php echo e($account->username); ?>"
                        data-email="<?php echo e($account->email); ?>"
                        data-firstName="<?php echo e($account->firstName); ?>"
                        data-middleName="<?php echo e($account->middleName); ?>"
                        data-lastName="<?php echo e($account->lastName); ?>"
                        data-birthDate="<?php echo e($account->birthDate); ?>"
                        data-nationality="<?php echo e($account->nationality); ?>"
                        data-sex="<?php echo e($account->sex); ?>"
                        data-contactNumber="<?php echo e($account->contactNumber); ?>"
                        data-restrict="<?php echo e($account->restrict); ?>"
                        data-restrictDays="<?php echo e($account->restrictDays); ?>"
                        data-accountType="<?php echo e($account->accountType); ?>"
                    >
                        Edit
                    </button>

                    <!-- Modal Structure (Only one modal for all accounts) -->
                    <div id="editAccountModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeEditModalX">
                                &times;
                            </span>

                            <?php echo $__env->make('includes_accounts.edit_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>
                    </div>

                    <!--delete button-->
                </td>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>

<!-- Modal for full text -->
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
            class="page-item <?php echo e($accounts->currentPage() == 1 ? 'disabled' : ''); ?>"
            aria-disabled="<?php echo e($accounts->currentPage() == 1); ?>"
        >
            <a
                class="page-link"
                href="<?php echo e($accounts->appends(request()->input())->previousPageUrl()); ?>"
                rel="prev"
            >
                &laquo;
            </a>
        </li>

        <?php for($i = 1; $i <= $accounts->lastPage(); $i++): ?>
            <li
                class="page-item <?php echo e($accounts->currentPage() == $i ? 'active' : ''); ?>"
            >
                <a
                    class="page-link"
                    href="<?php echo e($accounts->appends(request()->input())->url($i)); ?>"
                >
                    <?php echo e($i); ?>

                </a>
            </li>
        <?php endfor; ?>

        <li
            class="page-item <?php echo e($accounts->hasMorePages() ? '' : 'disabled'); ?>"
            aria-disabled="<?php echo e(! $accounts->hasMorePages()); ?>"
        >
            <a
                class="page-link"
                href="<?php echo e($accounts->appends(request()->input())->nextPageUrl()); ?>"
                rel="next"
            >
                &raquo;
            </a>
        </li>
    </ul>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_accounts/display_inc.blade.php ENDPATH**/ ?>