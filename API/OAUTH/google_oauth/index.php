<?php require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../components/universal_components/head_home.inc.php' ?>
<?php 
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../core_files/config.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../core_files/session_init.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../core_files/functions.php';

if(check_logged_in()) {
    header("Location: ../../../pages/user_pages/profile.php");
}

$google_client = new Google\Client;

$oauth_state = generate_oauth_state();

$_SESSION['oauth_state'] = $oauth_state;

$google_client->setState($oauth_state);


$google_client->setClientId($google_client_ID);
$google_client->setClientSecret($google_client_secret);
$google_client->setRedirectUri($google_client_URI);
$google_client->setAccessType($google_access_type ?? '');
$google_client->setPrompt($google_set_prompt ?? '');
$google_client->addScope("email");
$google_client->addScope("profile");

$google_url = $google_client->createAuthUrl();
?>
<body class="login-page-bg">

    <div class="login-container">
        <div class="login-card">
<a href="<?= xss_protect(BASE_URL); ?>./index.php" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Home
</a>
            
            <h2>Welcome Back</h2>
            <p>Login to continue your creative journey.</p>

            <form action="login.php" class="auth-form">
                <div class="social-auth">
                    <a href="<?= xss_protect($google_url); ?>" type="submit" class="social-btn google">
                        <i class="fa-brands fa-google"></i> Continue with Google
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>