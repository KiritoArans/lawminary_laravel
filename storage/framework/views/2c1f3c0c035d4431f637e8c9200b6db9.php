<!-- Add Forum Button -->
<button
    id="addForumButton"
    class="btn btn-success"
    data-bs-toggle="modal"
    data-bs-target="#addForumModal"
>
    Add Forum
</button>

<!-- Add Forum Modal -->
<div id="addForumModal" class="modal">
    <div class="modal-content">
        <span id="closeAddForumModal" class="close-button">&times;</span>
        <h2>Add New Forum</h2>
        <form
            id="addForumForm"
            method="POST"
            action="<?php echo e(route('admin.forums.add')); ?>"
        >
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="addForumName">Forum Name:</label>
                <input
                    type="text"
                    id="addForumName"
                    name="forum_name"
                    class="form-control"
                    required
                />
            </div>

            <div class="form-group">
                <label for="addForumDescription">Forum Description:</label>
                <textarea
                    id="addForumDescription"
                    name="forum_desc"
                    class="form-control"
                    required
                ></textarea>
            </div>

            <div class="form-group">
                <label for="addMembersCount">Members Count:</label>
                <input
                    type="number"
                    id="addMembersCount"
                    name="mem_count"
                    class="form-control"
                    required
                />
            </div>

            <button type="submit" class="btn btn-primary">Add Forum</button>
        </form>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_forums/forums_add_inc.blade.php ENDPATH**/ ?>