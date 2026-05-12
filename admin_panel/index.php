<?php 
require_once __DIR__ . '/../core_files/config.php';
require_once __DIR__ . '/../core_files/session_init.php';
require_once __DIR__ . '/../core_files/functions.php'; 
require_once __DIR__ . '/components/defined_code_admin.php';

$reject_Admin_request_location_header = __DIR__ . '/../index.php';
$location_header  = __DIR__ . '/../API/OAUTH/google_oauth/pages/user_pages/profile.php';
check_logged_in($location_header);
check_account_level_for_admin($reject_Admin_request_location_header);

global $dbconn;

$total_users_query = mysqli_query($dbconn, "SELECT COUNT(id) as total FROM oauth_users");
$total_users = mysqli_fetch_assoc($total_users_query)['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonrise Admin | Dashboard</title>
    <link rel="stylesheet" href="./assets/css/all_users.css">
    <link rel="stylesheet" href="./assets/css/main_dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php require_once __DIR__ . '/components/universal_components/nav_admin.inc.php'; ?>

    <main class="main-content">
        <header>
            <h1>System Overview</h1>
            <div class="user-info">
                <img src="<?= xss_protect($_SESSION['user_picture'] ?? ''); ?>" alt="Admin">
                <span><?= xss_protect($_SESSION['full_name'] ?? 'Administrator'); ?></span>
            </div>
        </header>

        <div class="welcome-banner">
            <div class="welcome-text">
                <h2>Welcome back, <?=  xss_protect(explode(' ', $_SESSION['full_name'])[0] ?? 'Admin'); ?>!</h2>
                <p>Here is what's happening with Sonrise Literature today.</p>
            </div>
            <i class='bx bxs-bolt' style="font-size: 3rem; color: var(--accent-gold);"></i>
        </div>

        <div class="stats-grid">
            <div class="stat-card">
                <i class='bx bxs-group'></i>
                <div>
                    <h3><?= number_format($total_users); ?></h3>
                    <p>Total Members</p>
                </div>
            </div>
            <div class="stat-card">
                <i class='bx bxs-book-heart'></i>
                <div>
                    <h3>48</h3>
                    <p>Published Poems</p>
                </div>
            </div>
            <div class="stat-card">
                <i class='bx bxs-show'></i>
                <div>
                    <h3>1.2k</h3>
                    <p>Monthly Views</p>
                </div>
            </div>
        </div>

        <div class="table-container">
            <div class="table-header">
                <h2>Last 5 Recent Joiners</h2>
                <a href="all_users.php" style="color: var(--crimson-red); text-decoration: none; font-size: 0.9rem; font-weight: 600;">View All</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email Address</th>
                        <th>Status</th>
                        <th>Joined</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $last_5_users_joined = get_recent_active_users_for_admin($dbconn);
                    if(!empty($last_5_users_joined)) {
                        foreach($last_5_users_joined as $user) {
                            $status_class = get_account_colour($user['account_status']);
                    }
                    ?>
                    <tr>
                        <td><strong><?= xss_protect($user['oauth_full_name']); ?></strong></td>
                        <td><?= xss_protect($user['oauth_email']); ?></td>
                        <td><span class="badge <?= $status_class; ?>"><?= ucfirst($user['account_status']); ?></span></td>
                        <td><?= date("M d, H:i", strtotime($user['created_at'])); ?></td>
                    </tr>
                    <?php 
                    } else { 
?>
    <tr>
        <td colspan="4" style="text-align:center;">No new users joined in the last 2 weeks.</td>
    </tr>
<?php }; ?>
                </tbody>
            </table>
        </div>

        <div class="quick-actions">
            <a href="<?= xss_protect(BASE_URL_ADMIN); ?>./pages/add_poem.php" class="action-card">
                <i class='bx bxs-pen'></i>
                <span>Write New Poem</span>
            </a>
            <a href="<?= xss_protect(BASE_URL_ADMIN); ?>./pages/all_users.php" class="action-card">
                <i class='bx bxs-user-plus'></i>
                <span>Manage Users</span>
            </a>
            <!-- <a href="#" class="action-card">
                <i class='bx bxs-bar-chart-alt-2'></i>
                <span>View Analytics</span>
            </a>
            <a href="#" class="action-card">
                <i class='bx bxs-envelope'></i>
                <span>System Emails</span>
            </a> -->
        </div>
    </main>

</body>
</html>