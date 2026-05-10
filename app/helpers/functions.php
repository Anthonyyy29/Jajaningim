<?php
function redirect($url) {
    header('Location: ' . $url);
    exit;
}

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function requireLogin() {
    if (!isLoggedIn()) {
        redirect('/login');
    }
}

function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}
