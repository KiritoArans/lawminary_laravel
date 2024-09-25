<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Lawminary | Moderator Forums</title>
        <link
            rel="icon"
            href="<?php echo e(asset('imgs/lawminarylogo.png')); ?>"
            type="image/png"
        />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/moderator/mforumsstyle.css')); ?>"
        />
        <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>" />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/admin/base_admin_table_style.css')); ?>"
        />
        <link
            rel="stylesheet"
            href="<?php echo e(asset('css/admin/base_admin_modal_style.css')); ?>"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        />
        <?php echo $__env->make('inclusions/libraryLinks', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </head>
    <body>
        <div class="container">
            <aside>
                <?php echo $__env->make('includes_accounts.mod_nav_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </aside>
            <main>
                <header>
                    <div class="header-top">
                        <?php echo $__env->make('includes_syscon.syscon_logo_inc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <div class="spacer"></div>
                    </div>
                    <hr class="divider" />
                </header>
                <section class="filter-container">
                    <div class="search-bar">
                        <input
                            type="text"
                            placeholder="Search for Forums or Key Words..."
                        />

                        <button class="custom-button" id="editButton">
                            Edit
                        </button>

                        <div id="editForumModal" class="modal">
                            <div class="modal-content">
                                <span
                                    class="close-button"
                                    id="closeEditForumModal"
                                >
                                    &times;
                                </span>
                                <h2>Edit Forum</h2>
                                <form id="editForumForm">
                                    <label for="editForumId">Forum ID:</label>
                                    <input
                                        type="text"
                                        id="editForumId"
                                        name="editForumId"
                                        readonly
                                    />

                                    <label for="editForumName">
                                        Forum Name:
                                    </label>
                                    <input
                                        type="text"
                                        id="editForumName"
                                        name="editForumName"
                                        required
                                    />

                                    <label for="editForumIssue">
                                        Forum Issue:
                                    </label>
                                    <input
                                        type="text"
                                        id="editForumIssue"
                                        name="editForumIssue"
                                        required
                                    />

                                    <label for="editForumDescription">
                                        Forum Description:
                                    </label>
                                    <input
                                        type="text"
                                        id="editForumDescription"
                                        name="editForumDescription"
                                        required
                                    />

                                    <label for="editMembersCount">
                                        Members Count:
                                    </label>
                                    <input
                                        type="number"
                                        id="editMembersCount"
                                        name="editMembersCount"
                                        required
                                    />

                                    <label for="editDateCreated">
                                        Date Created:
                                    </label>
                                    <input
                                        type="date"
                                        id="editDateCreated"
                                        name="editDateCreated"
                                        required
                                    />

                                    <label for="restrictForumAccess">
                                        Restrict Access:
                                    </label>
                                    <input
                                        type="checkbox"
                                        id="restrictForumAccess"
                                        name="restrictForumAccess"
                                    />

                                    <label for="archiveForum">
                                        Archive Forum:
                                    </label>
                                    <input
                                        type="checkbox"
                                        id="archiveForum"
                                        name="archiveForum"
                                    />

                                    <button type="submit" class="custom-button">
                                        Save Changes
                                    </button>
                                    <button
                                        type="button"
                                        class="custom-button"
                                        id="deleteForumButton"
                                    >
                                        Delete Forum
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="action-buttons">
                        <button class="custom-button" id="filterButton">
                            Filter
                        </button>

                        <div id="filterModal" class="modal">
                            <div class="modal-content">
                                <span
                                    class="close-button"
                                    id="closeFilterModal"
                                >
                                    &times;
                                </span>
                                <h2>Filter Forums</h2>
                                <form id="filterForm">
                                    <label for="filterForumId">Forum ID:</label>
                                    <input
                                        type="text"
                                        id="filterForumId"
                                        name="filterForumId"
                                    />

                                    <label for="filterForumName">
                                        Forum Name:
                                    </label>
                                    <input
                                        type="text"
                                        id="filterForumName"
                                        name="filterForumName"
                                    />

                                    <label for="filterForumDescription">
                                        Forum Description:
                                    </label>
                                    <input
                                        type="text"
                                        id="filterForumDescription"
                                        name="filterForumDescription"
                                    />

                                    <label for="filterMembersCount">
                                        Members Count:
                                    </label>
                                    <input
                                        type="number"
                                        id="filterMembersCount"
                                        name="filterMembersCount"
                                    />

                                    <label for="filterDateCreated">
                                        Date Created:
                                    </label>
                                    <input
                                        type="date"
                                        id="filterDateCreated"
                                        name="filterDateCreated"
                                    />

                                    <button type="submit" class="custom-button">
                                        Apply Filter
                                    </button>
                                </form>
                            </div>
                        </div>
                        <!-- Add Forum Button -->
                        <button class="custom-button" id="addForumButton">
                            Add Forum
                        </button>

                        <!-- Add Forum Modal -->
                        <div id="addForumModal" class="modal">
                            <div class="modal-content">
                                <span
                                    class="close-button"
                                    id="closeAddForumModal"
                                >
                                    &times;
                                </span>
                                <h2>Add Forum</h2>
                                <form id="addForumForm" method="POST" action="<?php echo e(route('createForum')); ?>" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?> 
                                    <?php echo $__env->make('inclusions/response', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                    <label for="addForumName">
                                        Forum Name:
                                    </label>
                                    <input
                                        type="text"
                                        id="addForumName"
                                        name="forumName"
                                        required
                                    />

                                    <label for="addForumPhoto">
                                        Forum Photo:
                                    </label>
                                    <input
                                        type="file"
                                        id="addForumPhoto"
                                        name="forumPhoto"
                                    />

                                    <label for="addForumDescription">
                                        Forum Description:
                                    </label>
                                    <input
                                        type="text"
                                        id="addForumDescription"
                                        name="forumDesc"
                                        required
                                    />

                                    <button type="submit" class="custom-button">
                                        Add Forum
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
                <content class="table-container">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Forum ID</th>
                                <th>Forum Name</th>
                                <th>Forum Description</th>
                                <th>Members Count</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="forumsTableBody">
                            <?php $__currentLoopData = $forums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $forum): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr data-forum-id="<?php echo e($forum->id); ?>">
                                <td><?php echo e($forum->id); ?></td>
                                <td><?php echo e($forum->forumName); ?></td>
                                <td><?php echo e($forum->forumDesc); ?></td>
                                <td><?php echo e($forum->forumPhoto); ?></td>
                                <td><?php echo e($forum->created_at); ?></td>
                                <td>
                                    <button class="action-button" data-forum-id="<?php echo e($forum->id); ?>">
                                        View
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div id="viewForumModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeViewForumModal">
                                &times;
                            </span>
                            <h2>Forum Details</h2>
                            <p>
                                <strong>Forum ID:</strong>
                                <span id="viewForumId"></span>
                            </p>
                            <p>
                                <strong>Forum Name:</strong>
                                <span id="viewForumName"></span>
                            </p>
                            <p>
                                <strong>Forum Issue:</strong>
                                <span id="viewForumIssue"></span>
                            </p>
                            <p>
                                <strong>Forum Description:</strong>
                                <span id="viewForumDescription"></span>
                            </p>
                            <p>
                                <strong>Members Count:</strong>
                                <span id="viewMembersCount"></span>
                            </p>
                            <p>
                                <strong>Date Created:</strong>
                                <span id="viewDateCreated"></span>
                            </p>
                        </div>
                    </div>
                </content>
            </main>
        </div>
        <script src="<?php echo e(asset('js/moderator_js/mforums_js.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/moderator/mforums.blade.php ENDPATH**/ ?>