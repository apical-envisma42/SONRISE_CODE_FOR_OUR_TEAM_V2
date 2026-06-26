<?php
header($_SERVER["SERVER_PROTOCOL"] . " 403 Forbidden", true, 403);

if (file_exists(__DIR__ . '/../../components/universal_components/head_home.inc.php')) {
    require_once __DIR__ . '/../../components/universal_components/head_home.inc.php';
}
?>
<link rel="stylesheet" href="<?= xss_protect(BASE_URL); ?>/assets/CSS/csrf_invalid.css">

<body class="bg-gray-50">

 
    <!-- Main Section Body Content Container -->
    <main>
        <div class="security-container">
            <div class="security-icon-wrapper">
                <i class="fa-solid fa-shield-halved"></i>
                <span class="badge-lock"><i class="fa-solid fa-lock"></i></span>
            </div>

            <br>
            <span class="security-tag">Security Alert &bull; 403 Forbidden</span>
            
            <h1>Verification Expired</h1>
            
            <p class="security-desc">
                The secure authorization token associated with your form action is completely invalid or has timed out. To defend your data integrity against Cross-Site Request Forgery (CSRF) anomalies, your transmission was halted.
            </p>

            <!-- Diagnostics Block layout mirror to Analysis layout format -->
            <div class="diagnostics-area">
                <h3> Common Causes & Remedies</h3>
                <ul class="diagnostics-list">
                    <li>
                        <i class="fa-solid fa-circle-chevron-right"></i>
                        <span>The submission form was left open for too long before executing save hooks.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-chevron-right"></i>
                        <span>Browser cookies, which maintain active verification sessions, are currently turned off.</span>
                    </li>
                    <li>
                        <i class="fa-solid fa-circle-chevron-right"></i>
                        <span>An unexpected interaction step interrupted your login session state parameters.</span>
                    </li>
                </ul>
            </div>

            <!-- Operational Interface Navigation Routing Map Controls -->
            <div class="action-row">
                <button type="button" 
                        class="btn_secondary" 
                        onclick="if(history.length > 1) { history.back(); } else { window.location.href='/'; }">
                    <i class="fa-solid fa-arrow-left"></i> Return to Form
                </button>
                
                <a href="<?= xss_protect(BASE_URL); ?>/index.php" class="btn_primary">
                    <i class="fa-solid fa-house"></i> Go to Homepage
                </a>
            </div>

        </div>
    </main>

<?php require_once __DIR__ . '/../../components/universal_components/footer.inc.php'; ?>

</body>
</html>