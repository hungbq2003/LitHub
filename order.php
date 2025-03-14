<?php
session_start();
include 'db.php';
include 'includes/header.php';

$session = session_id();
$conn->query("INSERT INTO orders (user_id, book_id, quantity)
              SELECT user_id, book_id, quantity FROM cart
              WHERE session_id='$session'");

$conn->query("DELETE FROM cart WHERE session_id='$session'");
echo "Book order placed successfully";

include 'includes/footer.php';
?>