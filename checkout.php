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

$user_id = $_SESSION['user_id']; // Ensure user is logged in
$session_id = session_id();

// Create 'orders' table if not exists
$sql_orders_table = "CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    product_id INT NOT NULL,
    description TEXT,
    price DECIMAL(10,2),
    quantity INT NOT NULL,
    size VARCHAR(50),
    image_path VARCHAR(255),
    status ENUM('Pending', 'Completed') DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql_orders_table);

// Move cart items to orders table
$sql = "INSERT INTO orders (user_id, product_id, description, price, quantity, size, image_path, status)
        SELECT ?, product_id, description, new_price, quantity, size, image_path, 'Pending' FROM cart WHERE session_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $session_id);
$stmt->execute();

// Clear cart after successful order placement
$delete_sql = "DELETE FROM cart WHERE session_id = ?";
$delete_stmt = $conn->prepare($delete_sql);
$delete_stmt->bind_param("s", $session_id);
$delete_stmt->execute();

echo json_encode(['status' => 'success']);
$conn->close();
?>
