<?php
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

$session_duration = 2592000;
$is_secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
ini_set('session.cookie_secure', $is_secure ? 1 : 0); 

if (session_status() !== PHP_SESSION_ACTIVE) {
    $current_domain = ($_SERVER['HTTP_HOST'] === 'localhost') ? '' : 'fixmyareaghana.com';
    session_name("SNR_SESS");
    session_set_cookie_params([
        'lifetime' => $session_duration,
        'path' => '/',
        'domain' => $current_domain, 
        'secure' => $is_secure,        
        'httponly' => true,               
        'samesite' => 'Lax'              
    ]);
    session_start();
}

require_once __DIR__ . '/functions.php';
generate_csrf_token(36);