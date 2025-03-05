<?php
session_start();
include 'db.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$result = $conn->query("SELECT * FROM users WHERE id=$user_id");
$user = $result->fetch_assoc();

echo "<h1>Welcome, user {$user['name']}</h1>";
echo "<p>Email: {$user['email']}</p>";
?>