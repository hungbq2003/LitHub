<?php
session_start();
include 'db.php';
include 'includes/header.php';

$query = $_GET['query'];
$result = $conn->query("SELECT * FROM books WHERE title LIKE '%$query%'");

echo "<h2>Search results for '$query'</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<div>
            <img src='{$row['image']}' width='100'>
            <h3>{$row['title']}</h3>
            <p>by {$row['author']}</p>
            <p>{$row['price']}</p>            
          </div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LitHub Books | Search results</title>
</head>
<body>
  
</body>
</html>