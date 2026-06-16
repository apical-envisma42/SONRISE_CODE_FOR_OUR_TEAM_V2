<?php
$display_name = isset($recepient_name) ? $recepient_name : 'Reader';
$provider_name = isset($api_provider) ? ucfirst($api_provider) : 'Google';
$node_ip = isset($ip_address) ? $ip_address : '127.0.0.1';
$current_time = date("F j, Y, g:i a") . ' UTC';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Access Granted // SONRISE</title>
</head>
<body style="margin: 0; padding: 0; background-color: #020617; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #020617; min-height: 100vh; padding: 40px 10px;">
        <tr>
            <td align="center" valign="top">
                
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px; background: #111827; background-image: linear-gradient(to bottom, #111827 0%, #020617 100%); border: 2px solid #dc3545; border-radius: 16px; padding: 40px 30px; box-shadow: 0px 10px 30px rgba(220, 53, 69, 0.2); text-align: left;">
                    
                    <tr>
                        <td align="center" style="padding-bottom: 30px; border-bottom: 1px solid rgba(220, 53, 69, 0.2);">
                            <img src="<?= xss_protect(BASE_URL); ?>/sonrise/assets/Logos/sonrise.png" alt="SONRISE Logo" width="150" style="display: block; border: 0; outline: none; text-decoration: none;" />
                            <h1 style="color: #ffffff; font-size: 20px; font-weight: 900; margin: 15px 0 0 0; text-transform: uppercase; letter-spacing: 2px;">
                                Authentication Success
                            </h1>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 30px 0 10px 0;">
                            <p style="color: #ffffff; font-size: 16px; margin-top: 0; margin-bottom: 15px;">
                                Hello <strong style="color: #dc3545; font-weight: 700;"><?= xss_protect($display_name); ?></strong>,
                            </p>
                            <p style="color: #9ca3af; font-size: 14px; line-height: 1.6; margin: 0;">
                                Your SONRISE account was successfully accessed via single sign-on. This security notification is automatically dispatched to confirm you recognize this active connection node.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 20px 0;">
                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="width: 100%; background-color: #020617; border-radius: 8px; border-left: 4px solid #dc3545; padding: 20px;">
                                <tr>
                                    <td style="font-family: monospace; font-size: 13px; color: #cbd5e1; line-height: 1.8;">
                                        <div style="margin-bottom: 6px;"><strong style="color: #dc3545; text-transform: uppercase;">Provider:</strong> <?= xss_protect($provider_name); ?> (OAuth 2.0)</div>
                                        <div style="margin-bottom: 6px;"><strong style="color: #dc3545; text-transform: uppercase;">Time:</strong> <?= xss_protect($current_time); ?></div>
                                        <div style="margin-bottom: 6px;"><strong style="color: #dc3545; text-transform: uppercase;">Method:</strong> Secure Gateway Handshake</div>
                                        <div><strong style="color: #dc3545; text-transform: uppercase;">IP Address:</strong> <span style="background: rgba(220, 53, 69, 0.1); padding: 2px 6px; border: 1px solid rgba(220, 53, 69, 0.2); border-radius: 4px; color: #ffffff; font-weight: bold;"><?= xss_protect($node_ip); ?></span></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 15px 0 30px 0;">
                            <table border="0" cellpadding="0" cellspacing="0" style="margin: 0 auto;">
                                <tr>
                                    <td align="center" style="border-radius: 8px; background-color: #dc3545;">
                                        <a href="<?= xss_protect(BASE_URL); ?>/pages/user_pages/profile.php" target="_blank" style="display: inline-block; padding: 15px 40px; color: #ffffff; font-size: 13px; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; text-decoration: none; border-radius: 8px; background: linear-gradient(to right, #dc3545, #9c1c27); box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);">
                                            Go to My Profile Page
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-bottom: 25px;">
                            <h2 style="font-size: 16px; font-weight: 800; color: #ffffff; margin-top: 0; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;">
                                Was This You?
                            </h2>
                            <p style="color: #9ca3af; font-size: 14px; line-height: 1.6; margin: 0;">
                                If you just authorized this access routine to log into the platform, you can safely disregard this alert message. If you are ever unsure of your credential security parameters, check your active application permissions within your <a href="https://myaccount.google.com/connections" target="_blank" style="color: #dc3545; text-decoration: underline; font-weight: 600;">Google Security Settings</a>.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding-bottom: 30px; border-bottom: 1px solid rgba(220, 53, 69, 0.2);">
                            <h2 style="font-size: 16px; font-weight: 800; color: #ffffff; margin-top: 0; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 1px;">
                                Important Security Notice
                            </h2>
                            <p style="color: #9ca3af; font-size: 14px; line-height: 1.6; margin: 0;">
                                If you did not personally trigger this authorization prompt, please terminate unrecognized application links immediately through your third-party account control dashboard. If you suspect your master identity profile has been structurally compromised, change your provider's (<span style="color: #dc3545; font-weight: bold;"><?= xss_protect($provider_name); ?></span>) access passwords right away.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding-top: 30px; color: #4b5563; font-size: 11px; font-family: monospace; text-transform: uppercase; letter-spacing: 1px; line-height: 1.5;">
                            <div>&copy; <?= xss_protect(date("Y")); ?> SonRise &bull; All Rights Reserved</div>
                            <div style="margin-top: 5px; color: #4b5563;">Crafted by <span style="color: #dc3545; font-weight: bold;">THE CODERS GROVE INITIATIVE</span></div>
                        </td>
                    </tr>

                </table>
                
            </td>
        </tr>
    </table>

</body>
</html>