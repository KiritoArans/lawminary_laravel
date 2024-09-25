<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lawminary | Admin</title>
    <link rel="icon" href="<?php echo e(asset('imgs/lawminarylogo.png')); ?>" type="image/png">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/accountstyle.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/nav_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/base_admin_table_style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/admin/base_admin_modal_style.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container-fluid my-4">
        <aside>
            <div class="top-nav">
                <div class="profile">
                    <div class="user-indicator">
                        <img src="../../imgs/user-img.png" alt="Profile Picture">
                        <label>@Username</label>
                    </div>
                </div>
                <nav>
                    <ul>
                        <li><a href="dashboard"><i class="fa-solid fa-chart-pie"></i><span>Dashboard</span></a></li>
                        <li><a href="postpage"><i class="fa-solid fa-envelope-open-text"></i><span>Posts</span></a></li>
                        <li><a href="account" class="current"><i class="fa-solid fa-user-gear"></i><span>Accounts</span></a></li>
                        <li><a href="forums"><i class="fa-solid fa-users"></i><span>Forums</span></a></li>
                        <li><a href="systemcontent"><i class="fa-solid fa-display"></i><span>System Content</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="bottom-nav">
                <a class="logout"><i class="fa-solid fa-right-from-bracket"></i><span>Log out</span></a>
            </div>
        </aside>
        <main>
            <header>
                <div class="header-top">
                    <img src="../../imgs/Lawminary_Logo_2-Gold.png" alt="Lawminary Logo">
                    <div class="spacer"></div>
                </div>
                <hr class="divider">
            </header>
            <section class="filter-container">
                <div class="search-bar">
                    <input type="text" id="search" placeholder="Search for User ID or Username...">
                </div>
                <div class="action-buttons">
                    <button class="custom-button" id="filterButton">Filter</button>
                    <div id="filterModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeFilterModal">&times;</span>
                            <h2>Filter Accounts</h2>
                            <!--filter accounts-->
                             <form id="filterForm" action="<?php echo e(route('admin.filter')); ?>" method="GET">
                                <label for="filterId">ID:</label>
                                <input type="text" id="filterId" name="filterId" value="<?php echo e(request('filterId')); ?>">
                            
                                <label for="filterUsername">Username:</label>
                                <input type="text" id="filterUsername" name="filterUsername" value="<?php echo e(request('filterUsername')); ?>">
                            
                                <label for="filterEmail">Email:</label>
                                <input type="text" id="filterEmail" name="filterEmail" value="<?php echo e(request('filterEmail')); ?>">
                            
                                <label for="filterAccountType">Account Type:</label>
                                <select id="accountType" name="accountType">
                                    <option value="all" <?php echo e(request('accountType') == 'all' ? 'selected' : ''); ?>>View All</option>
                                    <option value="Moderator" <?php echo e(request('accountType') == 'Moderator' ? 'selected' : ''); ?>>Moderator</option>
                                    <option value="User" <?php echo e(request('accountType') == 'User' ? 'selected' : ''); ?>>User</option>
                                    <option value="Lawyer" <?php echo e(request('accountType') == 'Lawyer' ? 'selected' : ''); ?>>Lawyer</option>
                                    <option value="Admin" <?php echo e(request('accountType') == 'Admin' ? 'selected' : ''); ?>>Admin</option>
                                </select>
                            
                                <button type="submit" class="custom-button">Apply Filter</button>
                            </form>
                        </div>
                    </div>
                     <!-- add accounts -->
                    <button class="custom-button" id="addButton">Add</button>
                    <div id="addModal" class="modal">
                        <div class="modal-content">
                            <span class="close-button" id="closeAddModal">&times;</span>
                            <h2>Add Account</h2>
                            
                        <form id="addForm" method="POST" action="<?php echo e(route('admin.addAccount')); ?>">
                            <?php echo csrf_field(); ?>
                            <?php if($errors->any()): ?>
                                <div class="error">
                                    <ul>
                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li><?php echo e($error); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" value="<?php echo e(old('firstName')); ?>" required>

                        <label for="middleName">Middle Name (optional): </label>
                        <input type="text" id="middleName" name="middleName" value="<?php echo e(old('middleName')); ?>">

                        <label for="lastName">Last Name:</label>
                        <input type="text" id="lastName" name="lastName" value="<?php echo e(old('lastName')); ?>" required>

                        <label for="birthDate">Birth Date:</label>
                        <input type="date" id="birthDate" name="birthDate" value="<?php echo e(old('birthDate')); ?>" required>

                        <label for="nationality">Nationality:</label>
                        <input type="text" id="nationality" name="nationality" value="<?php echo e(old('nationality')); ?>" required>

                        <label for="sex">Sex:</label>
                        <select id="sex" name="sex" required>
                            <option value="male" <?php echo e(old('sex') == 'male' ? 'selected' : ''); ?>>Male</option>
                            <option value="female" <?php echo e(old('sex') == 'female' ? 'selected' : ''); ?>>Female</option>
                            <option value="other" <?php echo e(old('sex') == 'other' ? 'selected' : ''); ?>>Other</option>
                        </select>

                        <label for="contactNumber">Contact Number:</label>
                        <input type="tel" id="contactNumber" name="contactNumber" value="<?php echo e(old('contactNumber')); ?>" required>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required>

                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo e(old('username')); ?>" required>

                        <label for="accountType">Account Type:</label>
                        <select id="accountType" name="accountType" required>
                            <option value="user" <?php echo e(old('accountType') == 'user' ? 'selected' : ''); ?>>User</option>
                            <option value="moderator" <?php echo e(old('accountType') == 'moderator' ? 'selected' : ''); ?>>Moderator</option>
                            <option value="lawyer" <?php echo e(old('accountType') == 'lawyer' ? 'selected' : ''); ?>>Lawyer</option>
                            <option value="admin" <?php echo e(old('accountType') == 'admin' ? 'selected' : ''); ?>>Admin</option>
                        </select>

                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>

                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>

                        <button type="submit" class="custom-button">Add Account</button>
                        </form>             
                             </div>
                                 </div>
                                    </div>
                                    <?php if($errors->any()): ?>
                                        <script>
                                            document.addEventListener("DOMContentLoaded", function() {
                                                // If there are errors, ensure the modal is open
                                                document.getElementById('addModal').style.display = 'block';
                                            });
                                        </script>
                                    <?php endif; ?>
                                </section>
                        <!-- display content on table -->
                    <content class="table-container">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>E-mail</th>
                                    <th>Account Type</th>
                                    <th>Sex</th>
                                    <th>Restrict</th>
                                    <th>Restrict Day(s)</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="accountTableBody">
                                <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($account->id); ?></td>
                                    <td><?php echo e($account->username); ?></td>
                                    <td><?php echo e($account->email); ?></td>
                                    <td><?php echo e($account->accountType); ?></td>
                                    <td><?php echo e($account->sex); ?></td>
                                    <td><?php echo e($account->restrict); ?></td>
                                    <td><?php echo e($account->restrictDays); ?></td>
                                    <td><?php echo e($account->created_at); ?></td>
                                    <td>
                                    <!--view/edit button-->
                                    <button type="button" class="custom-button edit-button"
                                    data-id="<?php echo e($account->id); ?>"
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
                                            <span class="close-button" id="closeEditModalX">&times;</span>
                                            <h2>Edit Account</h2>
                                            <?php if($errors->any()): ?>
                                                <div class="error2">
                                                    <ul>
                                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li><?php echo e($error); ?></li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </ul>
                                                </div>
                                            <?php endif; ?>
                                            <form id="editAccountForm" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                    <input type="hidden" id="editId" name="id" value="">
                                                                               
                                                    <label for="editUsername">Username</label>
                                                    <input type="text" id="editUsername" name="username" required value="">
                                         
                                                    <label for="editEmail">Email</label>
                                                    <input type="email" id="editEmail" name="email" required value="">
                                          
                                                    
                                        
                                                    <label for="editFirstName">First Name</label>
                                                    <input type="text" id="editFirstName" name="firstName" required value="">
                                            
                                                    <label for="editMiddleName">Middle Name (optional)</label>
                                                    <input type="text" id="editMiddleName" name="middleName" value="">
                                         
                                                    <label for="editLastName">Last Name</label>
                                                    <input type="text" id="editLastName" name="lastName" required value="">
                                          
                                                    <label for="editBirthDate">Birth Date</label>
                                                    <input type="date" id="editBirthDate" name="birthDate" required value="">
                                          
                                                    <label for="editNationality">Nationality</label>
                                                    <input type="text" id="editNationality" name="nationality" required value="">
                                            
                                                    <label for="editSex">Sex</label>
                                                    <select id="editSex" name="sex" value="">
                                                        <option value="Male" <?php echo e($account->sex == 'Male' ? 'selected' : ''); ?>>Male</option>
                                                        <option value="Female" <?php echo e($account->sex == 'Female' ? 'selected' : ''); ?>>Female</option>
                                                        <option value="Other" <?php echo e($account->sex == 'Other' ? 'selected' : ''); ?>>Other</option>
                                                    </select>
                                          
                                                    <label for="editContactNumber">Contact Number</label>
                                                    <input type="text" id="editContactNumber" name="contactNumber" required value="">
                                           
                                                    <label for="editRestrict">Restrict</label>
                                                    <select id="editRestrict" name="restrict" value="">
                                                    <option value="Yes" <?php echo e($account->editRestrict == 'Yes' ? 'selected' : ''); ?>>Yes</option>
                                                    <option value="No" <?php echo e($account->editRestrict == 'No' ? 'selected' : ''); ?>>No</option>
                                                    </select>
                            
                                                    <label for="editRestrictDays">Restrict Days</label>
                                                    <input type="number" id="editRestrictDays" name="restrictDays" value="<?php echo e($account->restrictDays); ?>" <?php echo e(!$account->restrict ? 'disabled' : ''); ?>>
                                        
                                                    <label for="editAccountType">Account Type</label>
                                                    <select id="editAccountType" name="accountType" value="">
                                                        <option value="User" <?php echo e($account->accountType == 'User' ? 'selected' : ''); ?>>User</option>
                                                        <option value="Lawyer" <?php echo e($account->accountType == 'Lawyer' ? 'selected' : ''); ?>>Lawyer</option>
                                                        <option value="Admin" <?php echo e($account->accountType == 'Admin' ? 'selected' : ''); ?>>Admin</option>
                                                        <option value="Moderator" <?php echo e($account->accountType == 'Moderator' ? 'selected' : ''); ?>>Moderator</option>
                                                    </select>

                                                    <button type="submit" class="custom-button">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                        <!--delete button-->
                                        <form id="delete-form-<?php echo e($account->id); ?>" action="<?php echo e(route('account.destroy', $account->id)); ?>" method="POST" style="display:inline;">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="button" class="delete-button" data-account-id="<?php echo e($account->id); ?>">Delete</button>
                                        </form>                                                                               
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </content>
        </main>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="<?php echo e(asset('js/admin_js/accounts_js.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\lawminary_laravel\resources\views\admin\account.blade.php ENDPATH**/ ?>