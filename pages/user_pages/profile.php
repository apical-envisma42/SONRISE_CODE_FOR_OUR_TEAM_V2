<?php require_once __DIR__ . '/../../components/universal_components/head_home.inc.php'; 
$location_header = __DIR__ . '/../../index.php';
$hidden_class = "";


if(!check_logged_in()) {
    header("Location: " . __DIR__ . '/../../API/OAUTH/google_oauth/index.php');
}
if(!is_user()):
    $hidden_class = "hidden_admin";
endif;

$user_contribution_level = "";
$class_logo_icon = "";
if($_SESSION['account_level'] === 'user') {
    $user_contribution_level = "Literary Explorer" ?? 'Literary Explorer';
}

if($_SESSION['oauth_provider'] === 'google') {
    $class_logo_icon = "fa-brands fa-google";
} 
?>

<style>
    .hidden_admin {
        display: none;
    }
</style>
<section class="profile-section">
    <div class="profile-card">
<!-- Top Section -->
<div class="profile-top">
    <div class="image-wrapper">
        <img src="<?= xss_protect($_SESSION['user_picture'] ?? 'assets/default-avatar.png'); ?>" alt="User Profile">
    </div>
    <img src="../../../PHP_API_INTERGRATION/ASSETS/" alt="">
    <h2><?= xss_protect($_SESSION['full_name'] ?? 'Unknown Explorer'); ?></h2>
    
    <span class="email-subtext"><?= xss_protect($_SESSION['user_email'] ?? 'No email provided'); ?></span>
    <span class="badge"><?= xss_protect($user_contribution_level) ?></span>
</div>
        <!-- Four-Point Info Grid -->
        <div class="profile-grid">
            <div class="grid-item">
                <span class="label">POEMS PUBLISHED</span>
                <span class="value">0 Works</span>
            </div>
            <div class="grid-item">
                <span class="label">AUTH METHOD</span>
                <span class="value"><i class="<?= xss_protect($class_logo_icon); ?>"></i> <?= xss_protect(ucfirst($_SESSION['oauth_provider'])); ?></span>
            </div>
            <div class="grid-item">
                <span class="label">MEMBER SINCE</span>
                <span class="value"></span>
            </div>
            <div class="grid-item">
                <span class="label">SECURITY STATUS</span>
                <span class="value"><i class="fa-solid fa-shield-halved"></i> Encrypted</span>
            </div>
        </div>

        <!-- Stacked Action Buttons -->

<div class="profile-actions-grid">
    
    <a href="../../admin_panel/index.php" class="btn-profile btn-admin <?= xss_protect($hidden_class ?? ''); ?>">
        <i class="fa-solid fa-screwdriver-wrench"></i> Admin Panel
    </a>

    <a href="../HTML/poems.php" class="btn-profile btn-explore">
        <i class="fa-solid fa-book-open"></i> Explore Poems
    </a>

    <a href="./user_inbox.php" class="btn-profile btn-inbox">
        <i class="fa-solid fa-envelope"></i> My Inbox
    </a>
    
    <form action="../../site_logic/logout/account_logout.php" method="POST" class="logout-form-wrapper">
        <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token'] ?? null); ?>">
        <button type="submit" name="account_logout" class="btn-profile btn-signout">
            <i class="fa-solid fa-right-from-bracket"></i> Sign Out
        </button>
    </form>

</div>

<div id="logoutModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <i class="fa-solid fa-circle-exclamation"></i>
            <h3>Confirm Sign Out</h3>
            <p>Are you sure you want to leave your session?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-cancel" onclick="toggleLogoutModal()">No, Stay</button>
            <form action="../../site_logic/logout/account_logout.php" method="post" style="display: inline;">
                <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token']) ?>">
                <button type="submit" name="account_logout" class="btn-confirm">Yes, Sign Out</button>
            </form>
        </div>
    </div>
</div>

<script src="../../assets/JS/sign_out_modal.js"></script>
        </form>
    </div>
</section>