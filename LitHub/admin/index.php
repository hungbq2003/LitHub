<?php
session_start();
include '../db.php';
include '../includes/header.php';

// Ommitting admin access for non-admin users
if (!isset($_SESSION['user_id']) || $_SESSION["role"] !== "admin") {
    header("Location: ../denied.php");
    exit();
}

// Fetch books
$result = $conn->query("SELECT * FROM books");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="add_book.php">Add new book</a>
    <h2>Book List</h2>
    <table border="1">
        <tr><th>ID</th><th>Title</th><th>Author</th><th>Price</th><th>Actions</th></tr>
        <?php while ($row = $result->fetch_assoc()) : ?>
        <tr>
            <td><?= $row['id']; ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['author']; ?></td>
            <td>£<?= $row['price']; ?></td>
            <td>
                <a href="edit_book.php?id=<?= $row['id']; ?>">Edit</a> |
                <a href="delete_book.php?id=<?= $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>