<?php
session_start();

// Destroy all session data
session_unset();
session_destroy();

// Redirect to login page
header("Location: home/index.php?success=You have logged out successfully");
exit;
?>
