<?php

// THIS IS FOR ALL RBAC STUFF

function check_logged_in(): bool {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function is_admin(): bool {
    if (!check_logged_in() || empty($_SESSION['account_level'])) {
        return false;
    }
    return strtolower(trim($_SESSION['account_level'])) === 'admin';
}

function is_user(): bool {
    if (!check_logged_in() || empty($_SESSION['account_level'])) {
        return false;
    }
    return strtolower(trim($_SESSION['account_level'])) === 'user';
}

function is_moderator(): bool {
    if (!check_logged_in() || empty($_SESSION['account_level'])) {
        return false;
    }
    return strtolower(trim($_SESSION['account_level'])) === 'moderator';
}

?>