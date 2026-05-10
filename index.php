<?php
$url = trim($_GET['url'] ?? 'home', '/');

require_once 'view/layout/header.php';
switch ($url) {
    case 'home':            require_once 'view/pages/home.php'; break;
    case 'login':           require_once 'view/pages/login.php'; break;
    case 'register':        require_once 'view/pages/register.php'; break;
    case 'forgot_password': require_once 'view/pages/forgot_password.php'; break;
    case 'games':           require_once 'view/pages/games.php'; break;
    case 'about':           require_once 'view/pages/about.php'; break;
    default:                require_once 'view/pages/home.php';
}
require_once 'view/layout/footer.php';
