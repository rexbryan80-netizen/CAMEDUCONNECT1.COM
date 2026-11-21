<?php
session_start();

// If user is not logged in as admin, redirect to login page
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: ..//login.php?error=Please login as admin to continue");
    exit();
}
?>
