<?php
session_start();

$product_id = $_POST['product_id'];
$description = $_POST['description'];
$new_price = $_POST['new_price'];
$quantity = $_POST['quantity'];
$size = $_POST['size'];
$image_path = $_POST['image_path'];

$is_in_cart = false;

// Check if the product is already in the cart
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $index => $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
            $is_in_cart = true;
            // Remove item from the cart
            unset($_SESSION['cart'][$index]);
            echo json_encode(['status' => 'removed']);
            exit();
        }
    }
}

// Add to cart if it's not already there
if (!$is_in_cart) {
    $new_item = [
        'product_id' => $product_id,
        'description' => $description,
        'new_price' => $new_price,
        'quantity' => $quantity,
        'size' => $size,
        'image_path' => $image_path
    ];
    $_SESSION['cart'][] = $new_item;
    echo json_encode(['status' => 'added']);
}
?>