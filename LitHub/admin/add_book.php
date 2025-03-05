<?php
include '..db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $price = $_POST['price'];
    $image = $_POST['image'];

    $conn->query("INSERT INTO books (title, author, price, image) VALUES ('$title', '$author', '$price', '$image')");
    header("Location: index.php");
}
?>

<form method="POST">
    <input type="text" name="title" placeholder="Title" required>
    <input type="text" name="author" placeholder="Author" required>
    <input type="number" step="0.01" name="price" placeholder="Price" required>
    <input type="text" name="image" placeholder="Image Filename (e.g., book1.jpg)" required>
    <button type="submit">Add Book</button>
</form>