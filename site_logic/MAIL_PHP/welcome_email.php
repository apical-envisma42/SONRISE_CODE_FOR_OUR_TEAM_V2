<?php
/**
 * Son-Rise Platform - Welcome & Authentication Security Email Template
 * Refactored with Crimson Red Branding & Literary Accents
 */

// Safety check to verify your sanitization function exists in the current scope
if (!function_exists('xss_protect')) {
    function xss_protect($string) {
        return htmlspecialchars($string ?? '', ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5 | ENT_DISALLOWED, 'UTF-8');
    }
}

// Sample variables for contextual fallback testing
$recepient_name = $recepient_name ?? 'Literary Explorer';
$api_provider = $api_provider ?? 'Google';
$ip_address = $ip_address ?? $_SERVER['REMOTE_ADDR'] ?? 'Unknown IP';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Son-Rise</title>
    <style>
        /* Embedded fallback styles for compliant clients */
        body { 
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important; 
            -webkit-font-smoothing: antialiased; 
            font-size: 15px; 
            line-height: 1.6; 
            color: #333333; 
            background-color: #f8f9fa; 
            margin: 0; 
            padding: 0; 
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
        }
        
        /* Layout Structure */
        .email-wrapper {
            background-color: #f8f9fa;
            padding: 40px 20px;
        }
        .email-container {
            max-width: 600px; 
            margin: 0 auto; 
            background-color: #ffffff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05);
            border-top: 6px solid #dc3545; /* Crimson Red Top Accent Border */
        }
        .header { 
            background-color: #ffffff; 
            padding: 45px 40px 30px 40px; 
            text-align: center; 
        }
        .content { 
            padding: 0 40px 40px 40px; 
        }
        .footer { 
            padding: 35px 40px; 
            background-color: #fafafa; 
            border-top: 1px solid #f0f0f0; 
            text-align: center; 
            font-size: 13px; 
            color: #777777; 
        }

        /* Typography */
        h1 { 
            font-size: 32px; 
            font-weight: 800; 
            color: #333333; 
            margin: 0 0 5px 0; 
            letter-spacing: -0.5px;
        }
        h1 span {
            color: #dc3545; /* Crimson Red brand split */
        }
        .subtitle {
            font-size: 12px;
            font-weight: 700;
            color: #888888;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }
        h2 { 
            font-size: 20px; 
            font-weight: 700;
            color: #333333; 
            margin-top: 0;
            margin-bottom: 15px; 
        }
        h3 { 
            font-size: 16px; 
            font-weight: 700;
            color: #333333; 
            margin-top: 30px; 
            margin-bottom: 8px; 
            border-bottom: 2px solid #dc3545;
            display: inline-block;
            padding-bottom: 3px;
        }
        p { 
            margin-top: 0; 
            margin-bottom: 18px; 
            color: #555555;
        }
        strong { 
            font-weight: 700; 
            color: #222222; 
        }

        /* Callout Box Refactored to Modern Soft Crimson */
        .status-box { 
            background-color: rgba(220, 53, 69, 0.04); 
            border-radius: 16px; 
            border-left: 4px solid #dc3545; 
            padding: 22px; 
            margin: 25px 0; 
            font-size: 14px; 
        }
        .status-item { 
            margin-bottom: 12px; 
            color: #444444;
            display: flex;
            justify-content: space-between;
        }
        .status-item:last-child {
            margin-bottom: 0;
        }
        .status-item strong { 
            color: #777777; 
            font-weight: 500;
        }
        .status-value {
            font-weight: 700;
            color: #333333;
        }
        .status-value.accent {
            color: #dc3545;
        }

        /* Buttons & Interactions matching UI Cards */
        .btn-container { 
            margin: 35px 0; 
            text-align: center; 
        }
        .btn-primary { 
            background-color: #dc3545; 
            color: #ffffff !important; 
            border-radius: 50px; 
            display: inline-block; 
            font-size: 15px; 
            font-weight: 600; 
            line-height: 52px; 
            text-align: center; 
            text-decoration: none; 
            padding: 0 35px;
            -webkit-text-size-adjust: none; 
            transition: all 0.3s ease; 
            box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
        }
        .btn-primary:hover { 
            background-color: #c22222; 
            box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
            transform: translateY(-2px);
        }
        a.security-link { 
            color: #dc3545; 
            text-decoration: underline; 
            font-weight: 600; 
        }
        a.security-link:hover {
            color: #c22222;
        }

        /* Mobile Adjustments */
        @media only screen and (max-width: 620px) { 
            .email-wrapper {
                padding: 10px 0;
            }
            .email-container { 
                width: 100% !important; 
                border-radius: 0; 
            } 
            .header, .content { 
                padding: 30px 20px; 
            } 
            .btn-primary { 
                width: 100%; 
                padding: 0;
            } 
            .status-item {
                flex-direction: column;
                gap: 2px;
            }
            .status-item style {
                text-align: left;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">

    <table role="presentation" class="email-wrapper" cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td align="center">
                
                <table role="presentation" class="email-container" cellspacing="0" cellpadding="0">
                    <tr>
                        <td class="header">
                            <h1>SON<span style="color: #dc3545;">RISE</span></h1>
                            <p class="subtitle">A Community of Stories & Verse</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="content">
                            <h2>Authentication Verified</h2>
                            <p>Hello <strong><?php echo xss_protect($recepient_name); ?></strong>,</p>
                            <p>Your secure account connection was accessed successfully. This automated notification ensures
                            the real-time integrity and visibility of your profile security configuration.</p>
                            
                            <div class="status-box">
                                <div class="status-item">
                                    <strong>Auth Method:</strong> 
                                    <span class="status-value"><?php echo ucfirst(xss_protect($api_provider)); ?> OAuth Link</span>
                                </div>
                                <div class="status-item">
                                    <strong>Timestamp:</strong> 
                                    <span class="status-value"><?php echo date("F j, Y, g:i a"); ?> UTC</span>
                                </div>
                                <div class="status-item">
                                    <strong>Security Layer:</strong> 
                                    <span class="status-value accent"><?= xss_protect($ip_address); ?></span>
                                </div>
                                <div class="status-item">
                                    <strong>Device IP Address:</strong> 
                                    <span class="status-value" style="font-family: monospace; font-size: 13px;"><?php echo xss_protect($ip_address); ?></span>
                                </div>
                            </div>

                            <div class="btn-container">
                                <a href="http://localhost/sonrise/pages/user_pages/poems.php" class="btn-primary">
                                    Explore Library & Poems
                                </a>
                            </div>

                            <h3>Verification Review</h3>
                            <p>If you initiated this verification check, you can completely ignore this security alert. If you ever need to audit or manage active API handshakes linked to your profile, look over your dashboard's global <a href="https://myaccount.google.com/connections" class="security-link" target="_blank">Google External Connections</a>.</p>

                            <h3>Safety Notice</h3>
                            <p>If you did not authorize this connection, please secure your keys immediately by severing unconfirmed session tokens. If you suspect any vulnerabilities with your credentials, we strongly encourage reviewing your primary identity verification profile configurations.</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <td class="footer">
                            <p style="margin: 0 0 8px 0;">This communication is an essential security tracking update for your platform account context.</p>
                            <p style="margin: 0; font-weight: 600;">&copy; <?php echo date("Y"); ?> Son-Rise Ecosystem. Developed securely on the LAMP Stack.</p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </table>

</body>
</html>