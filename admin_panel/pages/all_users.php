<?php 
require_once __DIR__ . '/../../core_files/config.php';
require_once __DIR__ . '/../../core_files/session_init.php';
require_once __DIR__ . '/../../core_files/functions.php'; 
require_once __DIR__ . '/../components/defined_code_admin.php';

$location_header  = __DIR__ . '/../../API/OAUTH/google_oauth/pages/user_pages/profile.php';
check_logged_in($location_header);

check_account_level_for_admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | User Management</title>
    <link rel="stylesheet" href="../assets/css/all_users.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php require_once __DIR__ . '/../components/universal_components/nav_admin.inc.php' ?>


    <main class="main-content">
        <header>
            <h1>User Management</h1>
            <div class="user-info">
                <span>Admin: Jaden</span>
                <img src="../site_images/fixmyareaghana-high-resolution-logo.png" alt="Admin">
            </div>
        </header>

        <div class="stats-grid">
            <div class="stat-card">
                <i class='bx bxs-user-check'></i>
                <div>
                    <h3>1,240</h3>
                    <p>Total Users</p>
                </div>
            </div>
            <div class="stat-card">
                <i class='bx bxs-user-plus'></i>
                <div>
                    <h3>12</h3>
                    <p>New Today</p>
                </div>
            </div>
        </div>

<div class="table-container">
    <div class="table-header">
        <h2>All Registered Accounts</h2>
        <input type="text" id="userSearch" placeholder="Search by ID, name, email..." onkeyup="searchUsers()">
    </div>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Provider</th>
                <th>User</th>
                <th>Email</th>
                <th>Joined Date</th>
                <th>Status</th>
                <th>Acc Level</th>
                <th>Picture</th>
                <th>Action</th>
            </tr>
        </thead>
       <tbody id="userTableBody">
    <?php 
    $sql = "SELECT id, oauth_provider, oauth_full_name, oauth_email, user_picture, account_status, acc_user_level, created_at FROM oauth_users";
    $query = mysqli_query($dbconn, $sql);
    
    while($row = mysqli_fetch_assoc($query)):
        $acc_Status = $row['account_status'];
        // Get the badge class from your helper function in functions.php
        $badgeClass = get_account_colour($acc_Status);
    ?>
    <tr>
        <td>#<?= xss_protect($row['id']); ?></td>
        <td><i class='bx bxl-google' style="color: #dc3545;" height="30px"></i> <?= xss_protect(ucfirst($row['oauth_provider'])); ?></td>
        <td class="user-cell">
            <strong><?= xss_protect($row['oauth_full_name']); ?></strong>
        </td>
        <td><?= xss_protect($row['oauth_email']); ?></td>
        <td><?= date("M d, Y", strtotime($row['created_at'])); ?></td>
        <td><span class="badge <?= xss_protect($badgeClass); ?>"><?= xss_protect($acc_Status); ?></span></td>
        <td><span class="badge active"><?= xss_protect($row['acc_user_level']); ?></span></td>
        <td>
            <img src="<?= xss_protect($row['user_picture']); ?>" alt="User" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border-color);">
        </td>
        <td class="action-cell">
            <button class="btn-edit" title="Edit"><i class='bx bxs-edit'></i></button>
            <button class="btn-delete" title="Delete"><i class='bx bxs-trash'></i></button>
        </td>
    </tr>
    <?php endwhile; ?>
</tbody>
    </div>
    </main>

    <script src="../assets/admin_js/search_all_users.js"></script>
</body>
</html>