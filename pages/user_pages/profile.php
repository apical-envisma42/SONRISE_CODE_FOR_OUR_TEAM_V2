<?php 
require_once __DIR__ . '/../../components/universal_components/head_home.inc.php'; 
$hidden_class = "";
$member_since = "Unknown";

if (!empty($_SESSION['account_creation'])) {
    $timestamp = strtotime($_SESSION['account_creation']);
    
    if ($timestamp) {
        $member_since = date("F Y", $timestamp);
    }
}

if(!check_logged_in()) {
    header("Location: " . __DIR__ . '/../../API/OAUTH/google_oauth/index.php');
    exit();
}

$user_contribution_level = "";
$class_logo_icon = "";

if($_SESSION['account_level'] === 'user') {
    $user_contribution_level = "Literary Explorer" ?? 'Literary Explorer';
    $hidden_class = "hidden_admin";
} elseif($_SESSION['account_level'] === 'admin') {
        $user_contribution_level = "Lord Of The Books" ?? 'Lord Of The Books';
        $hidden_class = "show_admin";
} else {
    $hidden_class = "hidden_admin";
}

if($_SESSION['oauth_provider'] === 'google') {
    $class_logo_icon = "fa-brands fa-google";
} 


?>

<style>
/* Core Structural Hiding Layer */
.hidden_admin {
    display: none !important;
    visibility: hidden !important;
    pointer-events: none !important;
}
</style>
<section class="profile-section">
    <div class="profile-card">
<!-- Top Section -->
<div class="profile-top">
    <div class="image-wrapper">
    <img src="<?= xss_protect($_SESSION['user_picture'] ?: '../../assets/Images/defaultavatar.svg'); ?>" alt="User Profile">    </div>
    <h2><?= xss_protect($_SESSION['full_name'] ?? 'Unknown Explorer'); ?></h2>
    
    <span class="email-subtext"><?= xss_protect($_SESSION['user_email'] ?? 'No email provided'); ?></span>
    <span class="badge"><?= xss_protect($user_contribution_level ?? 'Literary Explorer') ?></span>
</div>
        <!-- Four-Point Info Grid -->
        <div class="profile-grid">
            <div class="grid-item">
                <span class="label">POEMS PUBLISHED</span>
                <span class="value"><?= xss_protect($_SESSION['POEMS_ADDED'] ?? '0') ?> Works</span>
            </div>
            <div class="grid-item">
                <span class="label">AUTH METHOD</span>
                <span class="value"><i class="<?= xss_protect($class_logo_icon); ?>"></i> <?= xss_protect(ucfirst($_SESSION['oauth_provider'])); ?></span>
            </div>
            <div class="grid-item">
                <span class="label">MEMBER SINCE</span>
                <span class="value"><?= xss_protect($member_since); ?></span>
            </div>
            <div class="grid-item">
                <span class="label">SECURITY STATUS</span>
                <span class="value"><i class="fa-solid fa-shield-halved"></i> Encrypted</span>
            </div>
        </div>


<div class="profile-actions-grid">
    
    <a href="../../admin_panel/index.php" class="btn-profile btn-admin <?= xss_protect($hidden_class ?? 'hidden_admin'); ?>">
        <i class="fa-solid fa-screwdriver-wrench"></i> Admin Panel
    </a>

    <a href="./add_poem.php" class="btn-profile btn-explore">
        <i class="fa-solid fa-pen"></i> Add A Poem
    </a>

    <a href="../HTML/poems.php" class="btn-profile btn-explore">
        <i class="fa-solid fa-book-open"></i> Explore Literature
    </a>

    <a href="../HTML/podcasts.php" class="btn-profile btn-explore">
        <i class="fa-solid fa-microphone-lines"></i> Explore Podcasts
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