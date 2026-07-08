<?php $current_page = basename($_SERVER['PHP_SELF']); ?>
<style>
/* Sidebar Mobile Layout Integration */
.mobile-nav-toggle {
    display: none; /* Hidden by default on desktop view frameworks */
    position: fixed;
    top: 15px;
    left: 15px;
    background: var(--sidebar-bg);
    color: white;
    border: none;
    outline: none;
    width: 42px;
    height: 42px;
    border-radius: 8px;
    font-size: 1.5rem;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 100001; /* Layer over sidebar overlays safely */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.2s ease;
}

.mobile-nav-toggle:hover {
    background: var(--crimson-red);
}

/* Sidebar Logout Section Anchor Layout Framework override */
.logout-section {
    padding: 16px 24px;
    margin-top: auto; 
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.logout-section button {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
    background: transparent;
    border: none;
    outline: none;
    padding: 12px 16px;
    color: #94a3b8; 
    font-size: 0.95rem;
    font-weight: 600;
    font-family: inherit;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

.logout-section button i {
    font-size: 1.25rem;
    transition: transform 0.2s ease;
}

.logout-section button:hover {
    background-color: #fef2f2; 
    color: var(--crimson-red); 
}

.logout-section button:hover i {
    transform: translateX(-2px);
}

/* Dark Screen Overlay for mobile open frameworks */
.sidebar-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(15, 23, 42, 0.5);
    backdrop-filter: blur(4px);
    z-index: 99999;
}

@media (max-width: 1024px) {
    .mobile-nav-toggle {
        display: inline-flex;
    }
    .sidebar {
        transform: translateX(-100%);
        z-index: 100000;
        transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .sidebar.mobile-open {
        transform: translateX(0);
    }
    .sidebar-overlay.active {
        display: block;
    }
}
</style>

<!-- Mobile Toggle Menu Button Trigger -->
<button type="button" class="mobile-nav-toggle" id="menuToggleBtn" aria-label="Toggle Navigation Menu">
    <i class='bx bx-menu' id="menuIconElement"></i>
</button>

<!-- Dim Backdrop Overlay Shield Component -->
<div class="sidebar-overlay" id="sidebarBackdropShield" onclick="toggleMobileSidebar()"></div>

<nav class="sidebar" id="applicationSidebarWrapper">
    <div class="logo">
      <i class='bx bxs-book-heart' style="color: #dc3545"></i>
      <span>Sonrise Admin</span>
    </div>
    
    <ul class="nav-links">
        <li>
            <a href="<?= xss_protect(BASE_URL); ?>/index.php"><i class='bx bxs-dashboard'></i> Home Page</a>
        </li>

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
    </ul>

    <!-- Logout form correctly separated from core navigation metrics loop -->
    <form action="../../../site_logic/logout/account_logout.php" method="post" style="margin-top: auto; display: block; width: 100%;">
        <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token']); ?>">
        <div class="logout-section">
            <button type="submit" name="account_logout"><i class='bx bx-log-out'></i> Log Out</button>
        </div>
    </form>        
</nav>


</style>
<nav class="sidebar">
    <div class="logo">
      <i class='bx bxs-book-heart' style="color: #dc3545"></i>
      <span>Sonrise Admin</span>
    </div>
    <ul class="nav-links">
        <li>
            <a href="<?= xss_protect(BASE_URL); ?>/index.php"><i class='bx bxs-dashboard'></i> Home Page</a>
        </li>

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

<script>
function toggleMobileSidebar() {
    const sidebar = document.getElementById('applicationSidebarWrapper');
    const overlay = document.getElementById('sidebarBackdropShield');
    const toggleIcon = document.getElementById('menuIconElement');
    
    const isOpen = sidebar.classList.toggle('mobile-open');
    overlay.classList.toggle('active', isOpen);
    
    if(isOpen) {
        toggleIcon.classList.replace('bx-menu', 'bx-x');
    } else {
        toggleIcon.classList.replace('bx-x', 'bx-menu');
    }
}

document.getElementById('menuToggleBtn').addEventListener('click', toggleMobileSidebar);
</script>