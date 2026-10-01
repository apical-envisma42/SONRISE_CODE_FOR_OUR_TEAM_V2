<?php 
require_once __DIR__ . '/../../core_files/config.php';
require_once __DIR__ . '/../../core_files/session_init.php';
require_once __DIR__ . '/../../core_files/functions.php'; 
require_once __DIR__ . '/../components/defined_code_admin.php';
require_once __DIR__ . '/../admin_logic/check_user_admin.php';



global $dbconn;

$total_users_query = mysqli_query($dbconn, "SELECT COUNT(id) as total FROM oauth_users");
$total_users = mysqli_fetch_assoc($total_users_query)['total'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | User Management</title>
    <link rel="shortcut icon" href="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/Logos/sonrise.png" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/all_users.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<style>
.crimson-alert-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(15, 15, 20, 0.94); 
    z-index: 9999; 
    display: none;
    align-items: center;
    justify-content: center;
    opacity: 0;
    backdrop-filter: blur(5px);
    transition: opacity 0.25s ease-in-out;
}

.crimson-alert-overlay.active {
    display: flex;
    opacity: 1;
}

.crimson-alert-box {
    background: #fff;
    width: 100%;
    max-width: 460px;
    padding: 35px 30px;
    border-radius: 16px;
    text-align: center;
    box-shadow: 0 20px 40px rgba(220, 53, 69, 0.15), 0 0 0 1px rgba(220, 53, 69, 0.1);
    border-top: 6px solid #dc3545; 
    transform: scale(0.9);
    transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
    box-sizing: border-box;
}

.crimson-alert-overlay.active .crimson-alert-box {
    transform: scale(1);
}

.crimson-alert-icon {
    width: 64px;
    height: 64px;
    background: rgba(220, 53, 69, 0.08);
    color: #dc3545;
    font-size: 2.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin: 0 auto 20px auto;
    animation: crimsonPulse 2s infinite;
}

.crimson-alert-box h2 {
    font-family: 'Inter', sans-serif;
    color: #111;
    font-size: 1.4rem;
    font-weight: 700;
    margin: 0 0 12px 0;
}

.crimson-alert-box p {
    color: #555;
    font-size: 0.95rem;
    line-height: 1.6;
    margin: 0 0 28px 0;
}

.crimson-alert-box p strong {
    color: #dc3545;
    background: rgba(220, 53, 69, 0.05);
    padding: 2px 6px;
    border-radius: 4px;
    word-break: break-all; 
}

.crimson-alert-actions {
    display: flex;
    gap: 14px;
}

.alert-btn-cancel {
    flex: 1;
    background: #f4f4f6;
    border: 1px solid #e4e4e7;
    color: #555;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 0.9rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
}

.alert-btn-cancel:hover {
    background: #e4e4e7;
    color: #222;
}

.alert-btn-confirm {
    flex: 1;
    background: #dc3545;
    border: none;
    color: #fff;
    padding: 12px 20px;
    font-weight: 600;
    font-size: 0.9rem;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.2s;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
}

.alert-btn-confirm:hover {
    background: #b21f2d;
    box-shadow: 0 6px 15px rgba(220, 53, 69, 0.4);
}

@keyframes crimsonPulse {
    0% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0.4); }
    70% { box-shadow: 0 0 0 12px rgba(220, 53, 69, 0); }
    100% { box-shadow: 0 0 0 0 rgba(220, 53, 69, 0); }
}
    
.action-cell form {
    display: flex !important;
    flex-direction: row !important;
    align-items: center;
    gap: 8px; 
    margin: 0;
    padding: 0;
}
</style>


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
                    <h3><?= number_format($total_users); ?></h3>
                    <p>Total Users</p>
                </div>
            </div>
            <div class="stat-card">
                <i class='bx bxs-user-plus'></i>
                <div>
                    <h3>Unknown</h3>
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
                        $badgeClass = get_account_colour($acc_Status);
                    ?>
                    <tr>
                        <td>#<?= xss_protect($row['id']); ?></td>
                        <td><i class='bx bxl-google' style="color: #dc3545;" height="30px"></i> <?= xss_protect(ucfirst($row['oauth_provider'])); ?></td>
                        <td>
                            <strong><?= xss_protect($row['oauth_full_name']); ?></strong>
                        </td>
                        <td><?= xss_protect($row['oauth_email']); ?></td>
                        <td><?= date("M d, Y", strtotime($row['created_at'])); ?></td>
                        <td><span class="badge <?= xss_protect($badgeClass); ?>"><?= xss_protect($acc_Status); ?></span></td>
                        <td><span class="badge active"><?= xss_protect($row['acc_user_level']); ?></span></td>
                        <td>
                            <img src="<?= xss_protect($row['user_picture'] ?? '../../assets/Images/defaultavatar.svg'); ?>" alt="User" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 1px solid var(--border-color);">
                        </td>
                        <td class="action-cell">
                            <form id="delete-form-<?= $row['id']; ?>" action="../admin_logic/USER_MANAGEMENT_LOGIC/manage_users.php" method="post">
                                <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token']); ?>">
                                <input type="hidden" name="user_acc_level" value="<?= xss_protect($_SESSION['account_level']); ?>">
                                <input type="hidden" name="user_id" value="<?= xss_protect($row['id']); ?>">
                                <input type="hidden" name="delete_user" value="1">
                                
                                <button type="button" class="btn-edit" title="Edit"><i class='bx bxs-edit'></i></button>
                                
                                <button type="button" 
                                        class="btn-delete" 
                                        title="Delete" 
                                        onclick="triggerDeleteAlert(<?= $row['id']; ?>, '<?= addslashes(xss_protect($row['oauth_email'] ?? 'this account')); ?>')">
                                    <i class='bx bxs-trash'></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table> </div>
    </main>

    <div id="crimsonDeleteAlert" class="crimson-alert-overlay">
        <div class="crimson-alert-box">
            <div class="crimson-alert-icon">
                <i class='bx bxs-error-alt'></i>
            </div>
            <h2>Critical Action Required</h2>
            <p>Are you absolutely sure you want to permanently delete the user account associated with <strong id="deleteTargetEmail">this email</strong>? This structural modification cannot be undone.</p>
            
            <div class="crimson-alert-actions">
                <button class="alert-btn-cancel" onclick="dismissDeleteAlert()">Cancel</button>
                <button class="alert-btn-confirm" id="confirmDeleteSubmitBtn">Yes, Delete User</button>
            </div>
        </div>
    </div>

    <script src="../assets/admin_js/search_all_users.js"></script>
    <script src="../assets/admin_js/confirm_delete_user.js"></script>
</body>
</html>