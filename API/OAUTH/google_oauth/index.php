<?php require_once __DIR__ . DIRECTORY_SEPARATOR . '../../../components/universal_components/head_home.inc.php' ?>
<body class="login-page-bg">

    <div class="login-container">
        <div class="login-card">
<a href="../../index.php" onclick="if(document.referrer) { window.history.back(); return false; }" class="back-link">
    <i class="fa-solid fa-arrow-left"></i> Back to Home
</a>
            
            <h2>Welcome Back</h2>
            <p>Login to continue your creative journey.</p>

            <form action="login.php" class="auth-form">
                <div class="social-auth">
                    <a type="submit" class="social-btn google">
                        <i class="fa-brands fa-google"></i> Continue with Google
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>