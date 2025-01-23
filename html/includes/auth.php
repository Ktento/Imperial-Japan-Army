<?php
    session_start();

    $user_id = trim($_SESSION['loginid'] ?? '');
    $username = trim($_SESSION['user_name'] ?? '');
    $isAdmin = trim($_SESSION['role'] ?? '');

    if (empty($user_id)) {
        header("Location:login.php");
        exit();
    }

    function isAdmin() {
        return $isAdmin;
    }
?>