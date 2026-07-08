<?php
// Prevent direct web access to this template file
if (!defined('BASE_URL')) {
    exit('Direct access not permitted.');
}

/**
 * Variables expected before including this file:
 * @var string $author_name  - First name/Display name of the poet
 * @var string $poem_title   - Cleaned title of the approved piece
 * @var string $poem_slug    - URL slug to view the poem live
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Poem Published Live | SonRise</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc; margin: 0; padding: 0; color: #334155; }
        .email-container { max-width: 600px; margin: 40px auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border-top: 6px solid #10b981; }
        .email-header { padding: 32px 24px; text-align: center; background: #f0fdf4; }
        .email-header i { font-size: 3rem; color: #10b981; }
        .email-header h1 { margin: 12px 0 0 0; font-size: 1.5rem; color: #0f172a; }
        .email-body { padding: 32px 24px; line-height: 1.6; }
        .poem-badge { background: #f1f5f9; border-left: 4px solid #10b981; padding: 12px 16px; margin: 20px 0; font-weight: 600; font-style: italic; color: #1e293b; }
        .btn-link { display: inline-block; background-color: #dc3545; color: #ffffff !important; text-decoration: none; padding: 12px 24px; font-weight: 600; border-radius: 6px; margin: 16px 0; transition: background 0.2s; }
        .email-footer { padding: 24px; background: #f8fafc; text-align: center; font-size: 0.8rem; color: #64748b; border-top: 1px solid #e2e8f0; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Your Verse is Live!</h1>
        </div>
        <div class="email-body">
            <p>Greetings <?= htmlspecialchars($author_name); ?>,</p>
            <p>We are delighted to inform you that your submission has successfully passed our moderation review and has been officially published down to the platform catalog.</p>
            
            <div class="poem-badge">
                "<?= htmlspecialchars($poem_title); ?>"
            </div>
            
            <p>Your work is now public and ready to read. You can share your poem or review community impressions via the button interface below:</p>
            
            <p style="text-align: center;">
                <a href="<?= htmlspecialchars(BASE_URL ?? '', ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5 | ENT_DISALLOWED, 'UTF-8'); ?>/pages/HTML/poems.php?poem=<?= htmlspecialchars($poem_slug ?? '', ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5 | ENT_DISALLOWED, 'UTF-8'); ?>" class="btn-link" target="_blank">View Your Poem Live</a>
            </p>
            
            <p>Thank you for enriching the tapestry of SonRise with your authentic creative expression.</p>
            <p>Warmly,<br><strong>The SonRise Editorial Board</strong></p>
        </div>
        <div class="email-footer">
            &copy; <?= htmlspecialchars(date('Y') ?? '', ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5 | ENT_DISALLOWED, 'UTF-8');; ?> SonRise. All creative rights remain with the author.
        </div>
    </div>
</body>
</html>