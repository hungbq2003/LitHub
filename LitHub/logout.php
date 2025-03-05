<?php
    session_start();
    unset($_SESSION['user_id']); // Delete user_id session
    header("Location: index.php"); // Redirects back to Login page
    exit();
?>