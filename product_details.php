<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product_catalog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get product ID from URL
$product_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($product_id > 0) {
    // Fetch product details based on ID
    $sql = "SELECT description, old_price, new_price, discount_percentage, image_path FROM kurta WHERE product_id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Output the product details
        $row = $result->fetch_assoc();
        echo '<div class="product-detail">
                <img src="' . $row["image_path"] . '" alt="Picture">
                <h1>' . $row["description"] . '</h1>
                <p>Old Price: &#x20B9; ' . $row["old_price"] . '</p>
                <p>New Price: &#x20B9; ' . $row["new_price"] . '</p>
                <p>Discount: ' . number_format($row["discount_percentage"], 2) . '% off</p>
              </div>';
    } else {
        echo "Product not found.";
    }
} else {
    echo "Invalid product ID.";
}

// Close connection
$conn->close();
?>