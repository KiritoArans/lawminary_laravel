<form
    id="filterForm"
    method="GET"
    action="<?php echo e(route('moderator.filterLeaderboards')); ?>"
>
    <label for="filter_user_id">ID:</label>
    <input
        type="text"
        id="filter_user_id"
        name="filter_user_id"
        value="<?php echo e(request('filter_user_id')); ?>"
    />

    <label for="filterRank">Rank:</label>
    <input
        type="text"
        id="filterRank"
        name="filterRank"
        value="<?php echo e(request('filterRank')); ?>"
    />

    <label for="filterName">Name:</label>
    <input
        type="text"
        id="filterName"
        name="filterName"
        value="<?php echo e(request('filterName')); ?>"
    />

    <label for="filterPoints">Points:</label>
    <select id="filterPoints" name="filterPoints">
        <option value="">-- Select Points Range --</option>
        <!-- Default option -->
        <option
            value="0-200"
            <?php echo e(request('filterPoints') == '0-200' ? 'selected' : ''); ?>

        >
            0-200
        </option>
        <option
            value="201-500"
            <?php echo e(request('filterPoints') == '201-500' ? 'selected' : ''); ?>

        >
            201-500
        </option>
        <option
            value="501-1000"
            <?php echo e(request('filterPoints') == '501-1000' ? 'selected' : ''); ?>

        >
            501-1000
        </option>
        <option
            value="1001-2000"
            <?php echo e(request('filterPoints') == '1001-2000' ? 'selected' : ''); ?>

        >
            1001-2000
        </option>
        <option
            value="2001-3500"
            <?php echo e(request('filterPoints') == '2001-3500' ? 'selected' : ''); ?>

        >
            2001-3500
        </option>
        <option
            value="3501-5000"
            <?php echo e(request('filterPoints') == '3501-5000' ? 'selected' : ''); ?>

        >
            3501-5000
        </option>
        <option
            value="5001+"
            <?php echo e(request('filterPoints') == '5001+' ? 'selected' : ''); ?>

        >
            5001+
        </option>
    </select>

    <label for="filterBadge">Badge:</label>
    <select id="filterBadge" name="filterBadge">
        <option value="">-- Select Badge --</option>
        <!-- Default option -->
        <option
            value="Wood"
            <?php echo e(request('filterBadge') == 'Wood' ? 'selected' : ''); ?>

        >
            Wood
        </option>
        <option
            value="Steel"
            <?php echo e(request('filterBadge') == 'Steel' ? 'selected' : ''); ?>

        >
            Steel
        </option>
        <option
            value="Bronze"
            <?php echo e(request('filterBadge') == 'Bronze' ? 'selected' : ''); ?>

        >
            Bronze
        </option>
        <option
            value="Silver"
            <?php echo e(request('filterBadge') == 'Silver' ? 'selected' : ''); ?>

        >
            Silver
        </option>
        <option
            value="Gold"
            <?php echo e(request('filterBadge') == 'Gold' ? 'selected' : ''); ?>

        >
            Gold
        </option>
        <option
            value="Diamond"
            <?php echo e(request('filterBadge') == 'Diamond' ? 'selected' : ''); ?>

        >
            Diamond
        </option>
    </select>

    <button type="button" class="custom-button" onclick="resetFilter()">
        Reset Filter
    </button>

    <button class="custom-button" type="submit">Apply Filters</button>
</form>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views/includes_leaderboards/filter_lead_inc.blade.php ENDPATH**/ ?>