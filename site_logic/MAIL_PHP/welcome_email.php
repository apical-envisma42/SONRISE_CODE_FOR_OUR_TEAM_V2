<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Fix My Area Ghana</title>
    <style>
        /* Base styles */
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.6; color: #333; background-color: #f7f9fb; margin: 0; padding: 0; }
        table { border-collapse: collapse; width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff; }
        
        /* Layout */
        .header { background-color: #004d30; padding: 30px; text-align: center; color: #ffffff; }
        .logo { max-width: 150px; height: auto; }
        .content { padding: 40px; }
        .footer { padding: 30px; background-color: #f0f3f5; border-top: 1px solid #e1e8ed; text-align: center; font-size: 12px; color: #777; }

        /* Typography */
        h1 { font-size: 22px; font-weight: 700; color: #ffffff; margin-top: 15px; margin-bottom: 0; }
        h2 { font-size: 18px; color: #004d30; margin-bottom: 10px; }
        h3 { font-size: 16px; color: #333; margin-top: 25px; margin-bottom: 5px; }
        p { margin-top: 0; margin-bottom: 15px; }
        strong { font-weight: 600; color: #333; }

        /* Accents */
        .status-box { background-color: #f0f3f5; border-radius: 8px; border-left: 4px solid #ffd000; padding: 20px; margin: 25px 0; font-size: 13px; color: #555; }
        .status-item { margin-bottom: 10px; }
        .status-item strong { color: #004d30; }

        /* Buttons & Links */
        .btn-container { margin: 30px 0; text-align: center; }
        .btn-primary { background-color: #ffd000; color: #004d30; border-radius: 6px; display: inline-block; font-size: 14px; font-weight: 700; line-height: 50px; text-align: center; text-decoration: none; width: 220px; -webkit-text-size-adjust: none; transition: background-color 0.2s ease-in-out; }
        .btn-primary:hover { background-color: #e6bc00; }
        a.security-link { color: #d32f2f; text-decoration: underline; font-weight: 600; }

        /* Mobile adjustments */
        @media only screen and (max-width: 620px) { table { width: 100% !important; border-radius: 0; } .header, .content { padding: 20px; } .btn-primary { width: 100%; max-width: 250px; } }
    </style>
</head>
<body>
    <table role="presentation">
        <tr>
            <td class="header">
                <img src="../site_images/fixmyareaghana-high-resolution-logo.png" alt="Fix My Area Ghana Logo" class="logo">
                <h1>Authentication Success</h1>
            </td>
        </tr>
        <tr>
            <td class="content">
                <p>Hello <strong><?php echo xss_protect($recepient_name); ?></strong>,</p>
                <p>Your Fix My Area Ghana account was successfully accessed. This notification ensures you recognize this new connection.</p>
                
                <div class="status-box">
                    <div class="status-item"><strong>Provider:</strong> <?php echo ucfirst(xss_protect($api_provider)); ?> (OAuth)</div>
                    <div class="status-item"><strong>Time:</strong> <?php echo date("F j, Y, g:i a"); ?> GMT</div>
                    <div class="status-item"><strong>Method:</strong> Secure OAuth Authorization</div>
                    <div class="status-item"><strong>IP:</strong> <?php echo xss_protect($ip_address); ?></div>
                </div>

                <div class="btn-container">
                    <a href="https://your-fix-my-area.com/dashboard.php" class="btn-primary">Go to My Area Dashboard</a>
                </div>

                <h3>Was This You?</h3>
                <p>If you just authorized this connection, you can safely ignore this alert. If you are ever unsure, review your <a href="https://myaccount.google.com/connections" class="security-link">Google Security Settings</a>.</p>

                <h3>Important</h3>
                <p>If you did not authorize this access, please disconnect unrecognized sessions immediately through <strong>https://myaccount.google.com/connections</strong>. If you suspect your account is compromised, please update your main provider's (<?php echo ucfirst(xss_protect($api_provider ?? 'API PROVIDER')) ?>) credentials.</p>
            </td>
        </tr>
        <tr>
            <td class="footer">
                <p>&copy; <?php echo date("Y"); ?> Fix My Area Ghana. All Rights Reserved.</p>
                <p style="margin-bottom: 0;"><em>Improving our community, one report at a time.</em></p>
            </td>
        </tr>
    </table>
</body>
</html>