<?php 
require_once __DIR__ . '/../../core_files/config.php';
require_once __DIR__ . '/../../core_files/session_init.php';
require_once __DIR__ . '/../../core_files/functions.php'; 
$location_header  = __DIR__ . '/../../API/OAUTH/google_oauth/pages/user_pages/profile.php';

check_logged_in($location_header);
check_account_level_for_admin();

$token = $_SESSION['csrf_token'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sonrise Admin | Add Poem</title>
    <link rel="stylesheet" href="../assets/css/all_users.css">
    <link rel="stylesheet" href="../assets/css/add_poem.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>

<?php require_once __DIR__ . '/../components/universal_components/nav_admin.inc.php' ?>

    <main class="main-content">
        <header>
            <h1>Content Creator</h1>
            <div class="user-info">
                <img src="<?= xss_protect($_SESSION['user_picture'] ?? ''); ?>" alt="Admin">
                <span><?= xss_protect($_SESSION['full_name'] ?? 'Admin'); ?></span>
            </div>
        </header>

        <div class="form-card">
            <div class="form-header">
                <i class='bx bxs-pen'></i>
                <h2>Publish New Literature</h2>
            </div>
            
            <div class="form-body">
                <form action="../../site_logic/POST/save_poem.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="csrf_token" value="<?= xss_protect($token); ?>">

                    <div class="form-row">
                        <div class="form-group">
                            <label for="poem_title">Poem Title</label>
                            <input type="text" id="poem_title" name="poem_title" required placeholder="e.g., Whispers of Rain">
                        </div>

                        <div class="form-group">
                            <label for="poem_genre">Genre</label>
                            <select id="poem_genre" name="poem_genre" required>
                                <option value="" disabled selected>Select Genre</option>
                                <?php 
                                $sql = "SELECT poem_genre FROM `poem_genres` WHERE is_active = 1"; 
                                $stmt = mysqli_prepare($dbconn, $sql); 
                                mysqli_stmt_bind_result($stmt, $peom_genre);
                                mysqli_stmt_store_result($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                while($row = mysqli_fetch_assoc($result)):
                                ?>
                                <option value="<?= xss_protect($row['poem_genre']) ?>"></option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="poem_author">Author Name</label>
                        <input type="text" id="poem_author" name="poem_author" required placeholder="Display name of the poet">
                    </div>

                    <div class="form-group">
                        <label for="poem_image">Cover Image</label>
                        <div class="file-input-wrapper">
                            <input type="file" id="poem_image" name="poem_image" accept="image/*" required>
                            <small>Recommended size: 800x500px (JPG/PNG)</small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="poem_content">Poem Body</label>
                        <textarea id="poem_content" name="poem_content" required placeholder="Type the poem here..."></textarea>
                    </div>

                    <button type="submit" class="btn-publish">
                        <span>PUBLISH PIECE</span>
                        <i class='bx bxs-send'></i>
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>