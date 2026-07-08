<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<nav class="sidebar">
    <div class="logo">
      <i class='bx bxs-book-heart' style="color: #dc3545"></i>
      <span>Sonrise Admin</span>
    </div>
    <ul class="nav-links">
        <li class="<?= ($current_page == 'index.php') ? 'active' : '' ?>">
            <a href="<?= xss_protect(BASE_URL_ADMIN); ?>/index.php"><i class='bx bxs-dashboard'></i> Dashboard</a>
        </li>
        
        <li class="<?= ($current_page == 'all_users.php') ? 'active' : '' ?>">
            <a href="<?= xss_protect(BASE_URL_ADMIN); ?>/pages/all_users.php"><i class='bx bxs-group'></i> User Management</a>
        </li>

        <li class="<?= ($current_page == 'add_poem.php') ? 'active' : '' ?>">
            <a href="<?= xss_protect(BASE_URL_ADMIN); ?>/pages/add_poem_admin.php"><i class='bx bxs-edit-alt'></i> Add New Poem</a>
        </li>

        <li class="<?= ($current_page == 'review_poem.php') ? 'active' : '' ?>">
            <a href="<?= xss_protect(BASE_URL_ADMIN); ?>/pages/review_poem.php"><i class='bx bxs-edit-alt'></i> Review Poem</a>
        </li>
        <li class="<?= ($current_page == 'edit_poem.php') ? 'active' : '' ?>">
            <a href="<?= xss_protect(BASE_URL_ADMIN); ?>/pages/review_poem.php"><i class='bx bxs-edit-alt'></i> Edit Poem</a>
        </li>
        <li><a href="#"><i class='bx bxs-cog'></i> Settings</a></li>
    </ul>
    <form action="../../../site_logic/logout/account_logout.php" method="post">
    <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token']); ?>">
    <div class="logout-section">
        <button type="submit" name="account_logout" ><i class='bx bx-log-out'></i> Log Out</button>
    </div>
    </form>
</nav>