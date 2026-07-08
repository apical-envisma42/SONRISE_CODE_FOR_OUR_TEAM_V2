<?php 
require_once __DIR__ . '/../../core_files/init_core_files.php';
require_once __DIR__ . '/../components/defined_code_admin.php';


// Ensure user is authenticated before pulling data records
if(!check_logged_in()) {
    header("Location: " . BASE_URL . "/API/OAUTH/google_oauth/index.php");
    exit();
}

global $dbconn;

// --- CSRF TOKEN GENERATION ---
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$author_identity = $_SESSION['user_name'] ?? '';
$initial_token = !empty($author_identity) ? strtoupper(mb_substr(trim($author_identity), 0, 1, 'UTF-8')) : 'U';

$query = "SELECT id, poem_title, poem_slug, poem_genre, poem_content, poem_image, is_published, created_at 
          FROM poems 
          ORDER BY created_at DESC";

$user_poems_result = mysqli_query($dbconn, $query);

if (!$user_poems_result) {
    die("Database Workspace Error: Failed to compile selection statement framework. Reason: " . mysqli_error($dbconn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Creative Library | Sonrise</title>
    <link rel="shortcut icon" href="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/Logos/sonrise.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/css/review_poem.css">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/css/search_bar_admin.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-badge.live { background-color: #d1fae5; color: #065f46; }
        .status-badge.queued { background-color: #fef3c7; color: #92400e; }
        .poem-thumbnail {
            width: 50px; height: 50px; border-radius: 6px;
            object-fit: cover; border: 1px solid var(--border-color); background: #f1f5f9;
        }
        .meta-flex-cell { display: flex; align-items: center; gap: 14px; }
        .empty-state-card { text-align: center; padding: 60px 20px; color: var(--text-light); }
        .empty-state-card i { font-size: 3.5rem; color: #cbd5e1; margin-bottom: 16px; }
        .empty-state-card h3 { color: var(--text-dark); font-size: 1.25rem; margin-bottom: 8px; }
        .action-cell-cluster { display: flex; align-items: center; gap: 8px; }
        .btn-table-action {
            width: 36px; height: 36px; display: inline-flex; align-items: center;
            justify-content: center; border-radius: 6px; border: 1px solid var(--border-color);
            cursor: pointer; transition: all 0.2s ease;
        }
        .btn-table-action i { font-size: 1.2rem; }
        .btn-table-delete { background: #fef2f2; color: var(--crimson-red); border-color: #fca5a5; }
        .btn-table-delete:hover { background: var(--crimson-red); color: #ffffff; border-color: var(--crimson-red); }

        /* Modal Layout Rules Overlay */
        .crimson-alert-overlay {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(4px);
            z-index: 99999;
            display: none;
            align-items: center;
            justify-content: center;
        }
        .crimson-alert-box {
            background: #ffffff;
            padding: 32px;
            border-radius: 12px;
            width: 90%;
            max-width: 480px;
            text-align: center;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.2);
            border: 1px solid #fee2e2;
        }
        .crimson-alert-icon {
            width: 56px; height: 56px; background: #fef2f2; color: #dc2626;
            border-radius: 50%; display: flex; align-items: center; justify-content: center;
            font-size: 2rem; margin: 0 auto 16px auto;
        }
        .crimson-alert-box h2 { font-size: 1.4rem; color: #1e293b; margin-bottom: 12px; font-weight: 700; }
        .crimson-alert-box p { color: #64748b; font-size: 0.95rem; line-height: 1.5; margin-bottom: 24px; }
        .crimson-alert-actions { display: flex; gap: 12px; justify-content: center; }
        .alert-btn-cancel { background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 10px 20px; border-radius: 6px; font-weight: 600; cursor: pointer; }
        .alert-btn-confirm { background: #dc2626; color: #ffffff; border: none; padding: 10px 20px; border-radius: 6px; font-weight: 600; cursor: pointer; }
    </style>
</head>
<body>

    <?php require_once __DIR__ . '/../components/universal_components/nav_admin.inc.php'; ?>

    <main class="main-content">
        <?php if (isset($_GET['status'])): ?>
            <div style="background: #d1fae5; color: #065f46; padding: 16px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #a7f3d0; font-weight: 600;">
                <i class='bx bx-check-circle'></i> Action Processed Successfully: <?= xss_protect($_GET['status']); ?>
            </div>
        <?php endif; ?>

        <header>
            <div>
                <h1>My Creative Workspace</h1>
                <p style="color: var(--text-light); font-size: 0.9rem; margin-top: 4px;">Track, manage, and monitor all your submitted literary profiles.</p>
            </div>
            <div class="user-info">
                <span>Author: <?= xss_protect($author_identity); ?></span>
                <div style="width: 40px; height: 40px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #475569;">
                    <?= xss_protect($initial_token); ?>
                </div>
            </div>
        </header>

        <section class="moderation-container">
            <div class="search-bar">
                <i class='bx bx-search'></i>
                <input type="text" id="librarySearchInput" placeholder="Filter through titles or genres..." onkeyup="filterLibraryGrid()">
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Poem Master Details</th>
                            <th>Genre Class</th>
                            <th>Date Created</th>
                            <th>Moderation State</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="libraryTableBody">
                        <?php if (mysqli_num_rows($user_poems_result) > 0): ?>
                            <?php while ($poem = mysqli_fetch_assoc($user_poems_result)): ?>
                                <tr>
                                    <td>
                                        <div class="meta-flex-cell">
                                            <?php if (!empty($poem['poem_image'])): ?>
                                                <img src="<?= xss_protect(BASE_URL); ?>/uploads/poem_uploaded_images/<?= xss_protect($poem['poem_image']) ?>" class="poem-thumbnail" alt="Cover Art">
                                            <?php else: ?>
                                                <div class="poem-thumbnail" style="display:flex; align-items:center; justify-content:center; color:#94a3b8;">
                                                    <i class='bx bx-image' style="font-size: 1.5rem;"></i>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <div style="display: flex; flex-direction: column; gap: 2px;">
                                                <span class="searchable-title" style="font-weight: 600; color: var(--text-dark);"><?= xss_protect($poem['poem_title']); ?></span>
                                                <span style="color: var(--text-light); font-size: 0.85rem; max-width: 320px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                    <?= xss_protect(strip_tags($poem['poem_content'])); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td><span class="badge active searchable-genre"><?= xss_protect($poem['poem_genre']); ?></span></td>
                                    <td><?= date("M d, Y", strtotime($poem['created_at'])); ?></td>
                                    <td>
                                        <?php if (intval($poem['is_published']) === 1): ?>
                                            <span class="status-badge live"><i class='bx bx-check-circle'></i> Live Feed</span>
                                        <?php else: ?>
                                            <span class="status-badge queued"><i class='bx bx-time-five'></i> Under Review</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="action-cell-cluster">
                                            <?php if (intval($poem['is_published']) === 1): ?>
                                                <a href="<?= BASE_URL . '/pages/HTML/poems.php?poem=' . xss_protect($poem['poem_slug']); ?>" target="_blank" class="btn-table-action" style="background: #f1f5f9; color: #475569;" title="View Live">
                                                    <i class='bx bx-export'></i>
                                                </a>
                                            <?php else: ?>
                                                <button type="button" class="btn-table-action" style="background: #f1f5f9; color: #94a3b8; cursor: not-allowed;" disabled title="Pending Admin Approval">
                                                    <i class='bx bx-lock-alt'></i>
                                                </button>
                                            <?php endif; ?>

                                            <button type="button" class="btn-table-action btn-table-delete" 
                                                    data-id="<?= (int)$poem['id']; ?>"
                                                    data-title="<?= htmlspecialchars($poem['poem_title'], ENT_QUOTES, 'UTF-8'); ?>"
                                                    onclick="triggerUserDeletion(this)" 
                                                    title="Delete Permanent Submission">
                                                <i class='bx bx-trash-alt'></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">
                                    <div class="empty-state-card">
                                        <i class='bx bx-edit'></i>
                                        <h3>No verses found in your library</h3>
                                        <p>You haven't uploaded or submitted any poems to the platform yet.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <!-- Post Interception Form Block for Data Operations Processing -->
    <form id="directUserDestructionForm" action="<?= BASE_URL_ADMIN; ?>/admin_logic/POEM_MANAGEMENT_LOGIC/all_poems_logic.php" method="POST" style="display: none !important;">
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
        <input type="hidden" name="poem_id" id="destructionFormId" value="0">
        <input type="hidden" name="moderation_action" value="reject"> 
    </form>

<!-- Delete Confirmation Modal -->
<div id="crimsonDeleteAlert" class="crimson-alert-overlay">
    <div class="crimson-alert-box">
        <div class="crimson-alert-icon">
            <i class='bx bx-error-alt'></i>
        </div>

        <h2>Confirm Permanent Deletion</h2>

        <p>
            Are you completely sure you want to permanently delete
            <strong id="deleteTargetTitle">"this poem"</strong>?
        </p>

        <div class="crimson-alert-actions">
            <button type="button" class="alert-btn-cancel" onclick="dismissDeleteAlert()">
                Cancel
            </button>

            <button type="button" class="alert-btn-confirm" onclick="executePermanentDestruction()">
                Delete Permanently
            </button>
        </div>
    </div>
</div>


</body>
</html>
<?php mysqli_free_result($user_poems_result); ?>