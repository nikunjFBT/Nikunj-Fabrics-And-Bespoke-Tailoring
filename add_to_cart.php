<?php
session_start();
$host = "localhost"; // Change if needed
$username = "root"; // Change if using a different username
$password = ""; // Change if you have set a password
$database = "add_to_cart"; // Replace with your database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if required POST fields are set
if (!isset($_POST['product_id'], $_POST['description'], $_POST['new_price'], $_POST['quantity'], $_POST['size'], $_POST['image_path'])) {
    echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
    exit();
}

// Sanitize inputs
$product_id = intval($_POST['product_id']); // Ensure integer
$description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
$new_price = floatval($_POST['new_price']); // Ensure float
$quantity = intval($_POST['quantity']); // Ensure integer
$size = htmlspecialchars($_POST['size'], ENT_QUOTES, 'UTF-8');
$image_path = htmlspecialchars($_POST['image_path'], ENT_QUOTES, 'UTF-8');

$session_id = session_id(); // Unique session identifier

// Check if the item is already in the cart
$sql = "SELECT id FROM cart WHERE session_id = ? AND product_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $session_id, $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Remove item from cart
    $delete_sql = "DELETE FROM cart WHERE session_id = ? AND product_id = ?";
    $delete_stmt = $conn->prepare($delete_sql);
    $delete_stmt->bind_param("si", $session_id, $product_id);
    $delete_stmt->execute();
    
    echo json_encode(['status' => 'removed']);
} else {
    // Add new item to cart
    $insert_sql = "INSERT INTO cart (session_id, product_id, description, new_price, quantity, size, image_path) 
                   VALUES (?, ?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("sisdiss", $session_id, $product_id, $description, $new_price, $quantity, $size, $image_path);
    $insert_stmt->execute();
    
    echo json_encode(['status' => 'added']);
}

// Close database connection
$conn->close();
?>
