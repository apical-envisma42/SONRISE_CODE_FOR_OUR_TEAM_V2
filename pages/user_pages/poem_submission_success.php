<?php
require_once __DIR__ . '/../../components/universal_components/head_home.inc.php';
require_once __DIR__ . '/../../core_files/init_core_files.php';

// Ensure the user is logged in to view their submission status
if(!check_logged_in()) {
    header("Location: " . BASE_URL . "/API/OAUTH/google_oauth/index.php");
    exit();
}

$poem_title = $_GET['title'] ?? 'Your poem';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Received | Sonrise</title>
    <link rel="stylesheet" href="../assets/css/review_poem.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        .success-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 80vh;
            padding: 20px;
        }
        .success-card {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            max-width: 550px;
            width: 100%;
            padding: 40px 30px;
            text-align: center;
            border-top: 5px solid var(--crimson-red);
        }
        .success-icon-box {
            width: 80px;
            height: 80px;
            background: #fef2f2;
            color: var(--crimson-red);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3.5rem;
            margin: 0 auto 24px auto;
            animation: scaleIn 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .success-card h1 {
            color: var(--text-dark);
            font-size: 1.75rem;
            margin-bottom: 12px;
            font-weight: 700;
        }
        .success-card p {
            color: #64748b;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        .poem-target-badge {
            display: inline-block;
            background: #f1f5f9;
            color: #334155;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-style: italic;
            margin-bottom: 24px;
            border-left: 3px solid var(--crimson-red);
        }
        .info-timeline {
            text-align: left;
            background: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 32px;
            border: 1px solid var(--border-color);
        }
        .timeline-item {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
        }
        .timeline-item:last-child { margin-bottom: 0; }
        .timeline-item i {
            color: var(--crimson-red);
            font-size: 1.25rem;
            margin-top: 2px;
        }
        .timeline-text h4 {
            font-size: 0.9rem;
            color: var(--text-dark);
            margin-bottom: 2px;
            font-weight: 600;
        }
        .timeline-text p {
            font-size: 0.85rem;
            color: #64748b;
            margin-bottom: 0;
            line-height: 1.4;
        }
        .action-cluster {
            display: flex;
            gap: 12px;
            justify-content: center;
        }
        .btn-primary {
            background: var(--crimson-red);
            color: #ffffff;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: opacity 0.2s;
        }
        .btn-secondary {
            background: #f1f5f9;
            color: #475569;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: background 0.2s;
        }
        .btn-primary:hover { opacity: 0.9; }
        .btn-secondary:hover { background: #e2e8f0; }

        @keyframes scaleIn {
            0% { transform: scale(0); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }
    </style>
</head>
<body>

    <?php require_once __DIR__ . '/../../components/universal_components/nav_home.inc.php'; ?>

    <main class="main-content">
        <div class="success-wrapper">
            <div class="success-card">
                <div class="success-icon-box">
                    <i class='bx bx-git-pull-request'></i>
                </div>
                
                <h1>Submission Sent for Review!</h1>
                <p>Your piece has been successfully transmitted to our editorial queue. Thank you for sharing your perspective with Sonrise.</p>
                
                <div class="poem-target-badge">
                    <i class='bx bx-file' style="margin-right: 6px; vertical-align: middle;"></i><?= xss_protect($poem_title); ?>
                </div>

                <div class="info-timeline">
                    <div class="timeline-item">
                        <i class='bx bx-time-five'></i>
                        <div class="timeline-text">
                            <h4>Status: Pending Moderation</h4>
                            <p>An administrator will review your submission content to ensure formatting and layout look clear before publication.</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <i class='bx bx-bell'></i>
                        <div class="timeline-text">
                            <h4>Track Live Tracking</h4>
                            <p>You can check the real-time review status or look up options at any time inside your dashboard library workspace.</p>
                        </div>
                    </div>
                </div>

                <div class="action-cluster">
                    <!-- <a href="my_poems.php" class="btn-primary">Go to My Poems</a> -->
                    <a href="<?= xss_protect(BASE_URL); ?>/pages/user_pages/add_poem.php" class="btn-secondary">Submit Another</a>
                </div>
            </div>
        </div>
    </main>

</body>
</html>