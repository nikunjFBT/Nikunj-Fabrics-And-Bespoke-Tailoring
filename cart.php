<?php
// Start session
session_start();

// Check if the cart exists in the session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle removal of a product from the cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item'])) {
    $remove_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;

    // Find the product in the cart and remove it
    foreach ($_SESSION['cart'] as $key => $product) {
        if ($product['product_id'] === $remove_id) {
            // Remove the product from the session cart
            unset($_SESSION['cart'][$key]);
            break;
        }
    }

    // Redirect to the same page to reflect the changes
    header("Location: cart.php");
    exit();
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $product) {
    $total_price += $product['new_price'] * $product['quantity']; // Multiply new price by quantity for total
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .section-main {
            width: 100vw;
            padding: 0px 20px
            padding-top: calc(9vh + 20px);
            padding-bottom: 20px;
            display: flex;
            place-items: flex-start;
            justify-content: center;
            background-color: #ffffff; /* White background for contrast */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
            border-radius: 10px; /* Rounded corners for a softer look */
        }

        .section-main .container {
            display: flex;
            flex-direction: column;
            gap: 30px;
            padding: calc(9vh + 20px) 20px 20px;
        }

        table {
            width: 100%; /* Full width of the main section */
            border-collapse: collapse; /* Collapse borders for a cleaner look */
            margin-bottom: 20px; /* Space below the table */
        }

        table th,
        table td {
            border: 1px solid #ddd; /* Light gray border for table cells */
            padding: 12px; /* Padding inside table cells */
            text-align: center;
            font-size: 20px; /* Align text to the left */
            font-family: urbanist;
        }

        table th {
            background-color: #007965; /* Green background for header cells */
            color: white;
            letter-spacing: 0.5px; /* White text for header cells */
        }

        table img {
            width: 200px; /* Fixed width for product images */
        }

        table p{
            font-size: 20px;
        }

        h1{
            font-family: 'urbanist';
            letter-spacing: 1px;
            font-size: 26px;
            color: black;
            font-weight: 500;
        }

        h2 {
            color: #333; /* Dark gray color for total price heading */
            margin: 20px 0;
            font-size: 26px; /* Margin for spacing above and below */
            font-family: urbanist;
            font-weight:500;
        }

        .btn-remove{
            border: none;
            background-color: red;
            color: white;
            cursor: pointer;
            padding: 10px 25px;
            font-size: 16px;
            letter-spacing: 1px;
            border-radius: 5px;
        }

        .btn-remove:hover{
            opacity: 0.7;
        }

        .btn-proceed{
            padding: 20px 25px; 
            border: none; 
            cursor: pointer;
            font-weight: 500;
            color: white;
            font-size: 20px;
            font-family: 'urbanist';
            letter-spacing: 0.5px;
            border: none;
            border-radius: 5px;
            background-color: #007965;
        }

        .section-footer{
            margin-top: 0;
        }

    </style>
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
                    </ul></li>
                <li class="nav-list"><a href="#" class="nav-link" id="about">ABOUT</a></li>
            </ul>
        </div>
        <div class="cart">
            <ul>
                <li class="cart"><a href="login.php"><img src="ICONS/account-50.png" alt="Account" class="icon"></a></li>
                <li class="cart"><a href="#"><img src="ICONS/shopping-bag-50.png" alt="Shopping Bag" class="icon"></a></li>
            </ul>
        </div>
    </div>
</header>



<main class="section-main">
    <div class="container">
        <h1>My Bag</h1>

        <?php if (empty($_SESSION['cart'])): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th> <!-- New Total column -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" rowspan="5"><p>The Bag is empty.</p></td>
                    </tr>
                </tbody>
        </table>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total</th> <!-- New Total column -->
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $product): 
                        $product_total = $product['new_price'] * $product['quantity']; // Calculate total for the product
                    ?>
                        <tr>
                            <td>
                                <img src="<?php echo htmlspecialchars($product['image_path']); ?>" alt="<?php echo htmlspecialchars($product['description']); ?>">
                            </td>
                            <td><?php echo htmlspecialchars($product['description']); ?></td>
                            <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                            <td>&#x20B9; <?php echo htmlspecialchars($product['new_price']); ?></td>
                            <td>&#x20B9; <?php echo number_format($product_total, 2); ?></td> <!-- Display product total -->
                            <td>
                                <form method="post" action="" style="display:inline;">
                                    <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                    <button type="submit" name="remove_item" class="btn-remove">Remove</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="total-price">
                <h2>Total Price: &#x20B9; <?php echo number_format($total_price, 2); ?></h2>
            </div>
            
            <!-- Proceed to Payment Button -->
            <?php if (!empty($_SESSION['cart'])): ?>
                <form action="payment.html" method="get">
                    <button type="submit" class="btn-proceed">Proceed to Payment</button>
                </form>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</main>

<footer class="section-footer">
    <div class="container">
        <img src="NIKUNJ LOGO/N I K U N J1.png" alt="Nikunj" id="logo">
        <div class="social">
            <p>FOLLOW US ON</p>
            <ul>
                <li><a href="#" class="social-links" id="fb"><img src="ICONS/facebook.png" alt="">Facebook </a></li>
                <li><a href="#" class="social-links" id="insta"><img src="ICONS/instagram.png" alt="">Instagram </a></li>
                <li><a href="#" class="social-links" id="twt"><img src="ICONS/twitter.png" alt="">Twitter </a></li>
            </ul>
        </div>
        <div class="guide">
            <ul>
                <li><div class="div-img"><img src="ICONS/mguide-book-50.png" alt=""></div><a href="#" class="guide-links">Measurement Guide </a></li>
                <li><div class="div-img"><img src="ICONS/sewing-machine-50.png" alt=""></div><a href="#" class="guide-links">Custom Order </a></li>
                <li><div class="div-img"><img src="ICONS/all_india_delivery-50.png" alt=""></div><a href="#" class="guide-links">All India Delivery </a></li>
                <li><div class="div-img"><img src="ICONS/whatsapp-50.png" alt=""></div><a href="#" class="guide-links">Whatsapp Us </a></li>
            </ul>
        </div>
        <p>Copyright &copy Nikunj Fabrics & Bespoke Tailoring</p>
    </div>
</footer>
</body>
</html>
