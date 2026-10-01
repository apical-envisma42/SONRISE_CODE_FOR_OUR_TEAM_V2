<?php 
require_once __DIR__ . '/../../core_files/init_core_files.php';
require_once __DIR__ . '/../components/defined_code_admin.php';
require_once __DIR__ . '/../admin_logic/check_user_admin.php';

require_once __DIR__ . '/../components/universal_components/nav_admin.inc.php'; 

global $dbconn;

// 2. Safely capture the Target Record ID
$poem_id = intval($_GET['id'] ?? 0);
if ($poem_id <= 0) {
    header("Location: " . BASE_URL_ADMIN . "/pages/review_poem.php?msg=invalid_id");
    exit();
}

// 3. Fetch existing records for preparation values
$poem_title = '';
$poem_genre = '';
$poem_content = '';
$poem_image = '';
$poem_author = '';

$stmt = mysqli_prepare($dbconn, "SELECT poem_title, poem_genre, poem_content, poem_image, poem_author FROM poems WHERE id = ?");
if ($stmt) {
    mysqli_stmt_bind_param($stmt, "i", $poem_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result)) {
        $poem_title   = $row['poem_title'];
        $poem_genre   = $row['poem_genre'];
        $poem_content = $row['poem_content'];
        $poem_image   = $row['poem_image'];
        $poem_author  = $row['poem_author'];
    } else {
        header("Location: " . BASE_URL_ADMIN . "/pages/review_poem.php?msg=poem_not_found");
        exit();
    }
    mysqli_stmt_close($stmt);
}

$first_letter = !empty($_SESSION['full_name']) ? mb_substr($_SESSION['full_name'], 0, 1, 'UTF-8') : '';

// Map check to determine if the existing genre is a preset option
$preset_genres = ['Gothic Thriller', 'Romance', 'Love', 'Sad', 'Nature'];
$is_custom_genre = !in_array($poem_genre, $preset_genres);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Poem Entry | Sonrise Admin</title>
    <link rel="shortcut icon" href="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/Logos/sonrise.png" type="image/x-icon">
    <link rel="stylesheet" href="<?= xss_protect(BASE_URL_ADMIN); ?>/assets/css/review_poem.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .admin-form-card {
            background: var(--white);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            padding: 40px;
            margin-top: 20px;
        }
        .form-layout-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
            margin-bottom: 25px;
        }
        .admin-input-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .admin-input-group label {
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-light);
        }
        .admin-control-field {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-size: 0.95rem;
            outline: none;
            background: #ffffff;
            transition: border-color 0.2s;
        }
        .admin-control-field:focus {
            border-color: var(--crimson-red);
        }
        .admin-textarea {
            min-height: 250px;
            font-family: 'Georgia', serif;
            line-height: 1.6;
            resize: vertical;
        }
        .current-image-preview {
            display: flex;
            align-items: center;
            gap: 15px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border: 1px dashed var(--border-color);
            margin-top: 10px;
        }
        .current-image-preview img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 6px;
            border: 1px solid var(--border-color);
        }
        .admin-actions-row {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
            margin-top: 35px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
        }
        .btn-admin-cancel {
            padding: 12px 24px;
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background 0.2s;
            text-align: center;
        }
        .btn-admin-cancel:hover {
            background: #e2e8f0;
        }
        .btn-admin-submit {
            padding: 12px 28px;
            background: var(--crimson-red);
            color: var(--white);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.15);
            transition: background 0.2s;
        }
        .btn-admin-submit:hover {
            background: #b91c1c;
        }

        /* ==========================================================================
           RESPONSIVE FORM STRUCTURAL PATCHES
           ========================================================================== */
        @media (max-width: 768px) {
            .admin-form-card {
                padding: 20px; /* Reduces outer edge canvas spacing on mobile devices */
                margin-top: 12px;
            }

            .form-layout-grid {
                grid-template-columns: 1fr; /* Stacks layout elements into single columns */
                gap: 16px;
                margin-bottom: 16px;
            }

            .current-image-preview {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                padding: 12px;
            }

            .current-image-preview img {
                width: 50px;
                height: 50px;
            }

            .admin-actions-row {
                flex-direction: column-reverse; /* Stacks confirmation targets clearly on mobiles */
                gap: 10px;
                margin-top: 24px;
                padding-top: 16px;
            }

            .btn-admin-cancel, .btn-admin-submit {
                width: 100%; /* Spans element fields fluidly across the device screen layout */
                padding: 12px 16px;
            }
        }
    </style>
</head>
<body>

    <main class="main-content">
        <header>
            <h1>Modify Literature Entry</h1>
            <div class="user-info">
                <span>Admin: <?= xss_protect($_SESSION['full_name']) ?></span>
                <div style="width: 40px; height: 40px; background: #e2e8f0; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; color: #475569;"><?= xss_protect($first_letter); ?></div>
            </div>
        </header>

        <section class="moderation-container">
            <div class="admin-form-card">
                <form action="<?= xss_protect(BASE_URL_ADMIN); ?>/admin_logic/POEM_MANAGEMENT_LOGIC/edit_poem_logic.php" method="POST" enctype="multipart/form-data">
                    <!-- Session Security Verification Matrix -->
                    <input type="hidden" name="csrf_token" value="<?= xss_protect($_SESSION['csrf_token']); ?>">
                    <input type="hidden" name="poem_id" value="<?= $poem_id; ?>">

                    <div class="form-layout-grid">
                        <!-- Title Field Component -->
                        <div class="admin-input-group">
                            <label for="poem_title">Poem Title</label>
                            <input type="text" id="poem_title" name="poem_title" required class="admin-control-field" value="<?= xss_protect($poem_title); ?>">
                        </div>

                        <!-- Genre Dropdown Selector Logic mapping customized entries -->
                        <div class="admin-input-group">
                            <label for="poem_genre_select">Genre Configuration</label>
                            <select id="poem_genre_select" name="poem_genre" required class="admin-control-field" onchange="toggleAdminCustomGenre(this)">
                                <option value="Gothic Thriller" <?= $poem_genre === 'Gothic Thriller' ? 'selected' : ''; ?>>Gothic Thriller</option>
                                <option value="Romance" <?= $poem_genre === 'Romance' ? 'selected' : ''; ?>>Romance</option>
                                <option value="Love" <?= $poem_genre === 'Love' ? 'selected' : ''; ?>>Love</option>
                                <option value="Sad" <?= $poem_genre === 'Sad' ? 'selected' : ''; ?>>Sad</option>
                                <option value="Nature" <?= $poem_genre === 'Nature' ? 'selected' : ''; ?>>Nature</option>
                                <option value="OTHER_CUSTOM" <?= $is_custom_genre ? 'selected' : ''; ?>>Other (Custom Category Field)</option>
                            </select>

                            <div id="adminCustomGenreWrapper" style="display: <?= $is_custom_genre ? 'block' : 'none'; ?>; margin-top: 12px;">
                                <input type="text" id="custom_genre_input" name="custom_genre" class="admin-control-field" placeholder="Type customized genre..." maxlength="50" value="<?= $is_custom_genre ? xss_protect($poem_genre) : ''; ?>">
                            </div>
                        </div>
                    </div>

                    <!-- Authorship Attribution Header Read-Only Block -->
                    <div class="form-layout-grid" style="grid-template-columns: 1fr; margin-bottom: 25px;">
                        <div class="admin-input-group">
                            <label>Original Contributor Attribution</label>
                            <input type="text" class="admin-control-field" style="background: #f1f5f9; color: #64748b; cursor: not-allowed;" value="Submitted by: <?= xss_protect($poem_author); ?>" readonly>
                        </div>
                    </div>

                    <!-- Verses Core Document Editor Area Container -->
                    <div class="admin-input-group" style="margin-bottom: 25px;">
                        <label for="poem_content">The Verses (Body Content)</label>
                        <textarea id="poem_content" name="poem_content" required class="admin-control-field admin-textarea"><?= xss_protect($poem_content); ?></textarea>
                    </div>

                    <!-- Companion Graphic Element Modifier Area Container -->
                    <div class="admin-input-group">
                        <label for="poem_image">Replace Companion Background Image Artwork</label>
                        <input type="file" id="poem_image" name="poem_image" accept="image/*" class="admin-control-field">
                        
                        <?php if (!empty($poem_image)): ?>
                            <div class="current-image-preview">
                                <img src="<?= xss_protect(BASE_URL . '/' . $poem_image); ?>" alt="Background Illustration Thumbnail">
                                <div style="word-break: break-all;">
                                    <span style="font-size: 0.85rem; font-weight: 600; display: block; color: var(--text-dark);">Active Artwork Path on Disk:</span>
                                    <span style="font-size: 0.75rem; color: var(--text-light); font-family: monospace;"><?= xss_protect($poem_image); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Form Execution Row Interactions Mapping Actions Matrix -->
                    <div class="admin-actions-row">
                        <a href="<?= xss_protect(BASE_URL_ADMIN); ?>/pages/review_poem.php" class="btn-admin-cancel">Discard Changes</a>
                        <button type="submit" class="btn-admin-submit">Save System Records</button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <script>
        function toggleAdminCustomGenre(selectElement) {
            const customWrapper = document.getElementById('adminCustomGenreWrapper');
            const customInput = document.getElementById('custom_genre_input');
            
            if (selectElement.value === 'OTHER_CUSTOM') {
                customWrapper.style.display = 'block';
                customInput.setAttribute('required', 'required');
                customInput.focus();
            } else {
                customWrapper.style.display = 'none';
                customInput.removeAttribute('required');
            }
        }
    </script>
</body>
</html>