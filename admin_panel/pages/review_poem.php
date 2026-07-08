<?php 
require_once __DIR__ . '/../../core_files/init_core_files.php';
require_once __DIR__ . '/../components/defined_code_admin.php';
require_once __DIR__ . '/../components/universal_components/nav_admin.inc.php'; 

global $dbconn;

$query = "SELECT id, poem_title, poem_author, poem_genre, poem_content, created_at FROM poems WHERE is_published = 0 ORDER BY created_at DESC";
$pending_poems = mysqli_query($dbconn, $query);

$toast_status = $_GET['status'] ?? null;
$first_letter = !empty($_SESSION['full_name']) ? mb_substr($_SESSION['full_name'], 0, 1, 'UTF-8') : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poem Moderation Queue | Sonrise Admin</title>
    <link rel="shortcut icon" href="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/Logos/sonrise.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/css/review_poem.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/css/search_bar_admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
.toast-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #0f172a;
    color: #ffffff;
    padding: 16px 24px;
    border-radius: 8px;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 12px;
    z-index: 9999;
    transform: translateX(120%);
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    border-left: 4px solid #10b981;
}
.toast-notification.error-toast { border-left-color: #dc3545; }
.toast-notification.active { transform: translateX(0); }

.poem-meta-wrapper { display: flex; flex-direction: column; gap: 4px; }
.poem-title-text { font-weight: 600; color: #0f172a; font-size: 1rem; }
.poem-body-preview { color: #64748b; font-size: 0.875rem; font-style: italic; max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.action-cell-buttons { display: flex; gap: 8px; align-items: center; }

.action-cell-buttons {
    display: inline-flex;
    align-items: center;
    gap: 10px;
}

.btn-action-moderation {
    width: 38px;
    height: 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border: 1px solid transparent;
    outline: none;
    border-radius: 8px;
    cursor: pointer;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none; /* Safeguard styling fallback for anchor elements */
}

/* Icon Layout Settings */
.btn-action-moderation i {
    font-size: 1.35rem;
    transition: transform 0.2s ease;
}

.btn-mod-approve {
    background-color: #ecfdf5; 
    border-color: #a7f3d0;
    color: #059669;
}

.btn-mod-approve:hover {
    background-color: #10b981; 
    border-color: #10b981;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    transform: translateY(-1px);
}

.btn-mod-edit {
    background-color: #eff6ff; 
    border-color: #bfdbfe;
    color: #2563eb;
}

.btn-mod-edit:hover {
    background-color: #2563eb; 
    border-color: #2563eb;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.25);
    transform: translateY(-1px);
}

.btn-mod-reject {
    background-color: #fef2f2; 
    border-color: #fca5a5;
    color: var(--crimson-red);
}

.btn-mod-reject:hover {
    background-color: var(--crimson-red); 
    border-color: var(--crimson-red);
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(220, 53, 69, 0.25);
    transform: translateY(-1px);
}

.btn-action-moderation:active {
    transform: scale(0.95) translateY(0);
}
    </style>
    <link rel="shortcut icon" href="<?= xss_protect(BASE_URL); ?>/assets/Logos/sonrise.png" type="image/x-icon">
</head>
<body>

    <?php if ($toast_status === 'approved_success'): ?>
        <div id="toastNotification" class="toast-notification">
            <i class='bx bxs-check-circle' style="color: #10b981; font-size: 1.25rem;"></i>
            <span>Poem verified and published safely to live output feed.</span>
        </div>
    <?php elseif ($toast_status === 'reject_success'): ?>
        <div id="toastNotification" class="toast-notification error-toast">
            <i class='bx bxs-trash' style="color: #dc3545; font-size: 1.25rem;"></i>
            <span>Submission removed cleanly from storage records.</span>
        </div>
    <?php elseif ($toast_status === 'edit_success'): ?>
        <div id="toastNotification" class="toast-notification">
            <i class='bx bxs-edit-alt' style="color: #2563eb; font-size: 1.25rem;"></i>
            <span>Poem records successfully modified and updated.</span>
        </div>
    <?php endif; ?>

    <main class="main-content">

        <header>
            <h1>Poem Moderation</h1>
            <div class="user-info">
                <span>Admin: <?= xss_protect($_SESSION['full_name']) ?></span>
                <div style="width: 40px; height: 40px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #475569;"><?= xss_protect($first_letter); ?></div>
            </div>
        </header>

        <section class="moderation-container">
            <div class="search-bar">
                <i class='bx bx-search'></i>
                <input type="text" id="userSearch" placeholder="Search for poems..." onkeyup="searchPoems()">
            </div>

            <div class="table-container">
                <table class="responsive-moderation-table">
                    <thead>
                        <tr>
                            <th>Poem Details</th>
                            <th>Author</th>
                            <th class="hide-column-mobile">Author Email</th>
                            <th>Genre</th>
                            <th class="hide-column-tablet">Submission Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <?php if (mysqli_num_rows($pending_poems) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($pending_poems)): ?>
                                <tr>
                                    <td>
                                        <div class="poem-meta-wrapper">
                                            <span class="poem-title-text"><?= xss_protect($row['poem_title']); ?></span>
                                            <span class="poem-body-preview"><?= xss_protect(strip_tags($row['poem_content'])); ?></span>
                                        </div>
                                    </td>
                                    <td><?= xss_protect($row['poem_author']); ?></td>
                                    <td class="hide-column-mobile"><?= xss_protect($row['author_email'] ?? 'Anonymous') ?></td>
                                    <td><span class="badge active"><?= xss_protect($row['poem_genre']); ?></span></td>
                                    <td class="hide-column-tablet"><?= date("M d, Y", strtotime($row['created_at'])); ?></td>
                                    <td>
                                    <div class="action-cell-buttons">
                                        <a href="edit_poem.php?id=<?= intval($row['id']); ?>" 
                                           class="btn-action-moderation btn-mod-edit" 
                                           title="Edit Poem Records">
                                            <i class='bx bx-edit-alt'></i>
                                        </a>

                                        <button class="btn-action-moderation btn-mod-approve" 
                                                onclick="triggerModerationAlert(<?= $row['id']; ?>, '<?= addslashes(xss_protect($row['poem_title'])); ?>', 'approve')" 
                                                title="Approve & Publish Live">
                                            <i class='bx bx-check-shield'></i>
                                        </button>
                                        
                                        <button class="btn-action-moderation btn-mod-reject" 
                                                onclick="triggerModerationAlert(<?= $row['id']; ?>, '<?= addslashes(xss_protect($row['poem_title'])); ?>', 'reject')" 
                                                title="Reject & Shred Record">
                                            <i class='bx bx-trash-alt'></i>
                                        </button>
                                    </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="empty-state-cell" style="text-align: center; padding: 40px; color: #64748b;">
                                    <i class='bx bx-file-blank' style="font-size: 2.5rem; display:block; margin-bottom:10px;"></i>
                                    No pending items inside your moderation queues.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <div id="crimsonDeleteAlert" class="crimson-alert-overlay">
        <div class="crimson-alert-box">
            <div class="crimson-alert-icon" id="modalIconContainer">
                <i class='bx bxs-error-alt'></i>
            </div>
            <h2 id="modalHeaderTitle">Critical Action Required</h2>
            <p id="modalDescriptionText">Are you sure you want to alter the state of <strong id="deleteTargetTitle">this item</strong>?</p>
            
            <div class="crimson-alert-actions">
                <button class="alert-btn-cancel" onclick="dismissDeleteAlert()">Cancel</button>
                
                <form id="moderationActionForm" action="../admin_logic/POEM_MANAGEMENT_LOGIC/poem_moderate.php" method="POST" style="flex: 1; display: block !important;">
                    <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token']); ?>">
                    <input type="hidden" name="poem_id" id="modalPoemId" value="">
                    <input type="hidden" name="moderation_action" id="modalActionState" value="">
                    <button type="submit" class="alert-btn-confirm" id="modalSubmitActionBtn" style="width: 100%;">Confirm Action</button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/admin_js/review_poem.js"></script>
</body>
</html>