<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close-buttonEdit">&times;</span>
        <h2>Edit Forum</h2>
        <form id="editForm" method="POST" action="">
            <?php echo csrf_field(); ?>
            <?php echo method_field('POST'); ?>
            <input type="hidden" id="editId" name="id" />

            <div class="form-group">
                <label for="editName">Forum Name:</label>
                <input type="text" id="editName" name="forum_name" required />
            </div>

            <div class="form-group">
                <label for="editDesc">Description:</label>
                <input type="text" id="editDesc" name="forum_desc" required />
            </div>

            <div class="form-group">
                <label for="editMembers">Members Count:</label>
                <input
                    type="number"
                    id="editMembers"
                    name="mem_count"
                    required
                />
            </div>

            <button type="submit" class="btn btn-success">Update</button>
        </form>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_forums/forums_edit_inc.blade.php ENDPATH**/ ?>