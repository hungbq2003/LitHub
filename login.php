<?php
session_start();
include 'db.php';
include 'includes/header.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION["role"] = $user['role'];
        header("Location: index.php");
    } else {
        echo "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>LitHub Books | Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Login</h1>
<form method="POST">    
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>    
</body>
</html>
