<?php
include '../db.php';
session_start();

// Check if the admin account is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch books
$result = $conn->query("SELECT * FROM books");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
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
Add new book (admin/add_book.php)
<?php
include '../db.php';

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
    <button type="submit">Add new book</button>
</form>
Delete Book (admin/delete_book.php)
<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM books WHERE id=$id");
}

header("Location: index.php");
?>