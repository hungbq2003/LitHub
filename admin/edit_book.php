<?php
session_start();
include '../db.php';
include '../includes/header.php';

$id = intval($_GET['id']); // Ensure ID is an integer

// Fetch existing book data
$result = $conn->query("SELECT * FROM books WHERE id = $id");
if ($result->num_rows == 0) {
    die("Book not found.");
}
$book = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $conn->query("UPDATE books SET title='$title', author='$author', price='$price', image='$image' WHERE id=$id");
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h2>Edit Book</h2>
<form method="POST">
    <label>Book title:</label>
    <input type="text" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
    <label>Author:</label>
    <input type="text" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
    <label>Price (£):</label>
    <input type="number" step="0.01" name="price" value="<?= htmlspecialchars($book['price']) ?>" required>
    <label>Image File name:</label>
    <input type="text" name="image" value="<?= htmlspecialchars($book['image']) ?>" required>
    <button type="submit">Update book</button>
</form>    
</body>
</html>