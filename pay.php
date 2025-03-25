<?php
session_start();
$host = "localhost";
$username = "root";
$password = "";
$database = "add_to_cart";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "Cart is empty.";
    exit();
}

$user_id = 1; // Replace with actual logged-in user ID (if applicable)

foreach ($_SESSION['cart'] as $product) {
    $product_id = $product['product_id'];
    $description = $product['description'];
    $price = $product['new_price'];
    $quantity = $product['quantity'];
    $total_price = $price * $quantity;

    // Insert order into database
    $stmt = $conn->prepare("INSERT INTO orders (user_id, product_id, description, price, quantity, total_price) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iissid", $user_id, $product_id, $description, $price, $quantity, $total_price);
    $stmt->execute();
    $stmt->close();
}

// Clear the cart after successful order placement
unset($_SESSION['cart']);

echo "Order placed successfully!";
?>
