<?php 
session_start();
include 'db.php'; 
include 'includes/header.php';    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>LitHub Books</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Welcome to LitHub Books</h1>
    <form action="search.php" method="GET">
        <input type="text" name="query" placeholder="Search for books...">
        <button type="submit">Search</button>
    </form>

    <h2>Available Books</h2>
    <div class="books">
        <?php
        $result = $conn->query("SELECT * FROM books");
        while ($row = $result->fetch_assoc()) {
            echo "<div class='book'>
                    <img src='{$row['image']}' width='100'>
                    <h3>{$row['title']}</h3>
                    <p>by {$row['author']}</p>
                    <p>£{$row['price']}</p>
                    <a href='cart.php?add={$row['id']}'>Add to Cart</a>
                  </div>";
        }
        ?>
    </div>
</body>
</html>

<?php include 'includes/footer.php'; ?>