<?php
session_start(); // Start the session

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "product_catalog";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;

if ($product_id > 0) {
    $sql = "SELECT description, old_price, new_price, discount_percentage, image_path FROM kurta WHERE product_id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $description = $row['description'];
        $old_price = $row['old_price'];
        $new_price = $row['new_price'];
        $discount_percentage = number_format($row['discount_percentage'], 2);
        $image_path = $row['image_path'];
    } else {
        echo "<p>Product not found.</p>";
        exit();
    }
} else {
    echo "<p>Invalid product ID.</p>";
    exit();
}

// Check if the product is already in the cart
$is_in_cart = false;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cart_item) {
        if ($cart_item['product_id'] == $product_id) {
            $is_in_cart = true; // Product is already in the cart
            break;
        }
    }
}

// Handle form submission to add/remove from cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    $size = isset($_POST['size']) ? $_POST['size'] : 'Select Size';

    // Check if we need to remove the product
    if ($is_in_cart) {
        // Remove the product from the cart
        foreach ($_SESSION['cart'] as $index => $cart_item) {
            if ($cart_item['product_id'] == $product_id) {
                unset($_SESSION['cart'][$index]);
                break;
            }
        }
        // Reload the same page with a removal message
        header("Location: kurta_product.php?product_id=$product_id&removed_from_cart=true");
    } else {
        // Add the product to the session cart
        $cart_item = [
            'product_id' => $product_id,
            'description' => $description,
            'new_price' => $new_price,
            'quantity' => $quantity,
            'size' => $size,
            'image_path' => $image_path
        ];
        // Add to session cart
        $_SESSION['cart'][] = $cart_item;
        // Reload the same page with an addition message
        header("Location: kurta_product.php?product_id=$product_id&added_to_cart=true");
    }
    exit();
}
?>

<!-- Display success or removal messages
<?php if (isset($_GET['added_to_cart']) && $_GET['added_to_cart'] == 'true'): ?>
    <p class="success">Product successfully added to cart!</p>
<?php endif; ?>

<?php if (isset($_GET['removed_from_cart']) && $_GET['removed_from_cart'] == 'true'): ?>
    <p class="success">Product successfully removed from cart!</p>
<?php endif; ?> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="product_style.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="section-header">
        <div class="container">
            <div class="logo">
                <img src="NIKUNJ LOGO/N I K U N J.png" alt="Brand Logo">
            </div>
            <div class="navbar">
                <ul class="navmenu">
                    <li class="nav-list"><a href="index.html" class="nav-link">HOME</a></li>
                    <li class="nav-list" id="collections"><a href="#" class="nav-link">COLLECTIONS</a>
                        <ul class="popup">
                            <li><a href="kurta.php">Kurta</a></li>
                            <li><a href="sherwani.php">Sherwani</a></li>
                            <li><a href="jodhpuri.php">Jodhpuri</a></li>
                            <li><a href="suit.php">Suit</a></li>
                            <li><a href="#">Formal</a></li>
                        </ul>
                    </li>
                    <li class="nav-list"><a href="aboutus.html" class="nav-link" id="about">ABOUT</a></li>
                </ul>
            </div>
            <div class="cart">
                <ul>
                    <li class="cart"><a href="login.php"><img src="ICONS/account-50.png" alt="Account" class="icon"></a>
                    </li>
                    <li class="cart"><a href="cart.php"><img src="ICONS/shopping-bag-50.png" alt="Shopping Bag"
                                class="icon"></a></li>
                </ul>
            </div>
        </div>
    </header>
    <main class="section-main">
        <div class="container">
            <div class="box-1">
                <div class="image">
                    <img src="<?php echo htmlspecialchars($image_path); ?>" alt="Kurta Image">
                </div>
                <div class="details">
                    <p class="name"><?php echo htmlspecialchars($description); ?></p>
                    <p class="price">
                        <span class="op">MRP :
                            <span class="old-price">&#x20B9; <?php echo htmlspecialchars($old_price); ?></span>
                            <span class="new-price">&#x20B9; <?php echo htmlspecialchars($new_price); ?></span></span>
                        <span class="discount"><?php echo htmlspecialchars($discount_percentage); ?>% off</span>
                    </p>
                    <p class="tax">Price inclusive of all taxes</p>
                    <div class="fit">
                        <p>FIT :</p>
                        <p class="regular">Regular</p>
                    </div>

                    <!-- Add/Remove from Cart Form -->
                    <form action="" method="POST">
                        <div class="size-quantity">
                            <div class="size">
                                <label for="men-size">Size :</label>
                                <select name="size" id="men-size">
                                    <option value="select size">Select Size</option>
                                    <option value="small">S</option>
                                    <option value="medium">M</option>
                                    <option value="large">L</option>
                                    <option value="xl">XL</option>
                                    <option value="xxl">XXL</option>
                                </select>
                            </div>
                            <div class="quantity">
                                <label for="quantity">Quantity :</label>
                                <input type="number" name="quantity" class="qnt" min="1" value="1">
                            </div>
                        </div>
                        <!-- Dynamic Button: Add/Remove from Cart -->
                        <button type="submit" class="btn-cart"
                            style="background-color: <?php echo $is_in_cart ? 'red' : '#00aaff'; ?>;">
                            <?php echo $is_in_cart ? 'Remove from Cart' : 'Add to Cart'; ?>
                        </button>
                    </form>
                    <!-- End of Add/Remove from Cart Form -->
                </div>
            </div>
        </div>
    </main>

    <footer class="section-footer">
        <div class="container">
            <img src="NIKUNJ LOGO/N I K U N J1.png" alt="Nikunj" id="logo">
            <div class="social">
                <p>FOLLOW US ON</p>
                <ul>
                    <li><a href="#" class="social-links" id="fb"><img src="ICONS/facebook.png" alt="">Facebook </a></li>
                    <li><a href="#" class="social-links" id="insta"><img src="ICONS/instagram.png" alt="">Instagram </a>
                    </li>
                    <li><a href="#" class="social-links" id="twt"><img src="ICONS/twitter.png" alt="">Twitter </a></li>
                </ul>
            </div>
            <div class="guide">
                <ul>
                    <li>
                        <div class="div-img"><img src="ICONS/mguide-book-50.png" alt=""></div><a href="#"
                            class="guide-links">Measurement Guide </a>
                    </li>
                    <li>
                        <div class="div-img"><img src="ICONS/sewing-machine-50.png" alt=""></div><a href="#"
                            class="guide-links">Custom Order </a>
                    </li>
                    <li>
                        <div class="div-img"><img src="ICONS/all_india_delivery-50.png" alt=""></div><a href="#"
                            class="guide-links">Delivery All Over India </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
    <script>
    document.getElementById('cart-btn').addEventListener('click', function() {
        const form = document.getElementById('cart-form');
        const formData = new FormData(form);

        fetch('update_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'added') {
                    document.getElementById('cart-btn').textContent = 'Remove from Bag';
                    document.getElementById('cart-btn').style.backgroundColor = 'red';
                } else if (data.status === 'removed') {
                    document.getElementById('cart-btn').textContent = 'Add to Bag';
                    document.getElementById('cart-btn').style.backgroundColor = '#00aaff';
                }
            });
    });
    </script>

</body>

</html>