<?php
session_start();
include 'db.php';
include 'includes/header.php';

// Ensure user is logged in
// if (!isset($_SESSION['user_id'])) {
//     die("You must be <a href='login.php'>logged in</a> to add items to your cart.");
// }

$session = session_id();

// Add a book to cart
if (isset($_GET['add'])) {
    $book_id = $_GET['add'];

    $check = $conn->query("SELECT * FROM cart WHERE book_id = $book_id AND session_id = '$session'");

    if ($check->num_rows > 0) {
        $conn->query("UPDATE cart SET quantity = quanity + 1 WHERE book_id = $book_id AND session_id = '$session'");

    } else {
        $conn->query("INSERT INTO cart (user_id, book_id, quantity, session_id) VALUES (1, $book_id, 1, '$session')");
    }
    header("Location: cart.php");
    exit();
}

// Remove a book from cart
if (isset($_GET['remove'])) {
    $cart_id = $_GET['remove'];
    $conn->query("DELETE FROM cart WHERE id=$cart_id");
    header("Location: cart.php");
    exit();
}

// Update product quantity
if (isset($_POST['update_quantity'])) {
    $cart_id = $_POST['cart_id'];
    $new_quantity = (int)$_POST['quantity']; // Inject style to not getting SQL injection error

    if ($new_quantity > 0) {
        $conn->query("UPDATE cart SET quantity = $new_quantity WHERE id = $cart_id");
    } else {
        // If product quantity is 0 or lower, that product will be removed from cart
        $conn->query("DELETE FROM cart WHERE id = $cart_id");
    }
    header("Location: cart.php");
    exit();
}

// Display all cart items
$result = $conn->query("SELECT cart.id, books.title, books.price, cart.quantity 
                        FROM cart JOIN books ON cart.book_id = books.id 
                        WHERE cart.session_id= '$session'");

echo "<h2>My Cart</h2>";

echo "<form method='POST' action='cart.php'>";
while ($row = $result->fetch_assoc()) {
    echo "<p>{$row['title']} - {$row['price']} x 
    <input type='number' name='quantity' value='{$row['quantity']}' min='1' style='width:50px'>
    <input type='hidden' name='cart_id' value='{$row['id']}'>
    <button type='submit' name='update_quantity'>Update</button>
    <a href='cart.php?remove={$row['id']}'>Remove</a></p>";
}
echo "</form>"

?>
<a href="order.php">Check Out</a>

<?php include 'includes/footer.php'; ?>