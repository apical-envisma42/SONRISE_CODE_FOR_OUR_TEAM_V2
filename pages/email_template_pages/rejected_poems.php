<?php
if (!defined('BASE_URL')) {
    exit('Direct access not permitted.');
}

/**
 * Variables expected before including this file:
 * @var string $author_name  - First name/Display name of the poet
 * @var string $poem_title   - Cleaned title of the rejected piece
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Update | SonRise</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc; margin: 0; padding: 0; color: #334155; }
        .email-container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border-top: 6px solid #dc3545; }
        .email-header { padding: 32px 24px; text-align: center; background: #fef2f2; }
        .email-header h1 { margin: 12px 0 0 0; font-size: 1.5rem; color: #0f172a; }
        .email-body { padding: 32px 24px; line-height: 1.6; }
        .poem-badge { background: #f1f5f9; border-left: 4px solid #dc3545; padding: 12px 16px; margin: 20px 0; font-weight: 600; color: #475569; }
        .btn-link { display: inline-block; background-color: #f1f5f9; color: #475569 !important; text-decoration: none; padding: 12px 24px; font-weight: 600; border-radius: 6px; margin: 16px 0; border: 1px solid #e2e8f0; }
        .email-footer { padding: 24px; background: #f8fafc; text-align: center; font-size: 0.8rem; color: #64748b; border-top: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Submission Status Update</h1>
        </div>
        <div class="email-body">
            <p>Hello <?= htmlspecialchars($author_name); ?>,</p>
            <p>Thank you for taking the time to share your literary work with us. Our editorial queue recently reviewed your piece submission:</p>
            
            <div class="poem-badge">
                "<?= htmlspecialchars($poem_title); ?>"
            </div>
            
            <p>Regrettably, we are unable to publish your piece on our main feeds at this time. This is typically due to a layout variance, standard formatting deviations, or core curation alignment guidelines.</p>
            
            <p>Please do not let this deter you—rejection is an inherent component of the creative progression. We strongly encourage you to re-align your work, adjust formatting layouts, and submit an alternate draft.</p>
            
            <p style="text-align: center;">
                <a href="<?= BASE_URL; ?>/pages/user_pages/add_poem_admin.php" class="btn-link">Submit an Alternative Draft</a>
            </p>
            
            <p>We appreciate your dedication to the craft and wish you the absolute best in your writing journey.</p>
            <p>Sincerely,<br><strong>The SonRise Editorial Board</strong></p>
        </div>
        <div class="email-footer">
            &copy; <?= date('Y'); ?> SonRise Portal.
        </div>
    </div>
</body>
</html>