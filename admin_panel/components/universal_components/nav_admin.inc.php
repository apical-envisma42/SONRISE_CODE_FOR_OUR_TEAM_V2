<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<style>
    /* Sidebar Logout Section Anchor */
.logout-section {
    padding: 16px 24px;
    margin-top: auto; /* Pushes the logout block cleanly to the bottom of the sidebar */
    border-top: 1px solid var(--border-color);
}

/* Raw Button Override Matrix */
.logout-section button {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
    background: transparent;
    border: none;
    outline: none;
    padding: 12px 16px;
    color: #64748b; /* Muted slate gray to sit subtly at the bottom */
    font-size: 0.95rem;
    font-weight: 600;
    font-family: inherit;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

/* Icon Resizing */
.logout-section button i {
    font-size: 1.25rem;
    transition: transform 0.2s ease;
}

/* Hover State Interactions */
.logout-section button:hover {
    background-color: #fef2f2; /* Ultra-light crimson/red tint background */
    color: var(--crimson-red); /* Changes text to match your core crimson brand identity */
}

/* Tiny interaction to make the logout arrow slide slightly on hover */
.logout-section button:hover i {
    transform: translateX(-2px);
}
</style>
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

        <li class="<?= ($current_page == 'review_poem.php') ? 'active' : '' ?>">
            <a href="<?= xss_protect(BASE_URL_ADMIN); ?>/pages/review_poem.php"><i class='bx bx-clipboard'></i> Review Poem</a>
        </li>

        <li class="<?= ($current_page == 'all_poems.php') ? 'active' : '' ?>">
            <a href="<?= xss_protect(BASE_URL_ADMIN); ?>/pages/all_poems.php"><i class='bx bx-library'></i> All Poems</a>
        </li>

        <li class="<?= ($current_page == 'all_poems.php') ? 'active' : '' ?>">
    <form action="../../../site_logic/logout/account_logout.php" method="post">
    <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token']); ?>">
    <div class="logout-section">
        <button type="submit" name="account_logout" ><i class='bx bx-log-out'></i> Log Out</button>
    </div>
    </form>        
</li>
      
    </ul>

</nav>