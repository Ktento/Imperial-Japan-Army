<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user_id = trim($_SESSION['loginid'] ?? '');
$username = trim($_SESSION['user_name'] ?? '');
$isAdmin = (trim($_SESSION['role'] ?? '') === '管理者');


if (empty($user_id)) {
    header("Location:login.php");
    exit();
}
