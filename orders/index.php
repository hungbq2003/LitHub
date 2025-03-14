<?php
include '../db.php';

$result = $conn->query("SELECT orders.id, users.name, books.title, orders.quantity, orders.status 
                        FROM orders
                        JOIN users ON orders.user_id = users.id
                        JOIN books ON orders.book_id = books.id");

echo "<h2>Order Management</h2>";
echo "<table border='1'>";
echo "<tr><th>Order ID</th><th>Customer</th><th>Book</th><th>Quantity</th><th>Status</th><th>Action</th></tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['name']}</td>
            <td>{$row['title']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['status']}</td>
            <td>
                <a href='update_status.php?id={$row['id']}&status=shipped'>Mark as Shipped</a> |
                <a href='update_status.php?id={$row['id']}&status=delivered'>Mark as Delivered</a>
            </td>
          </tr>";
}

echo "</table>";
?>