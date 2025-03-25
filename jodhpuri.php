<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "product_catalog");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch all jodhpuri products from the database
$sql = "SELECT * FROM jodhpuri";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jodhpuri Section</title>
    <link rel="stylesheet" href="style.css">
    <style>
    .section-main .container .address {
        width: 153.6rem;
        padding: 2rem;
        display: flex;
        flex-direction: row;
        height: 1.5rem;
        background-color: #e8e8e8;
        place-items: center;
        gap: 0.4rem;
    }

    .section-main .container .address a,
    .path {
        font-size: 1.7rem;
        letter-spacing: 0.3rem;
    }

    .section-main .container .section-browse {
        width: 153.6rem;
        padding: 2rem;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        justify-items: center;
        gap: 2rem;
    }

    a {
        color: black;
    }

    .section-main .container .section-browse .product {
        width: 36rem;
    }

    .section-main .container .section-browse .product img {
        width: 36rem;
    }

    .section-main .container .section-browse .product .name {
        font-weight: 400;
        font-size: 1.8rem;
        word-spacing: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .section-main .container .section-browse .product .price {
        font-size: 1.8rem;
        font-weight: 600;
        display: flex;
        flex-direction: row;
        justify-content: space-between;

    }

    .section-main .container .section-browse .product .old-price {
        color: rgb(156 156 156);
        text-decoration: line-through;
        margin-right: 2rem;
    }

    .section-main .container .section-browse .product .new-price {
        color: black;
    }

    .section-main .container .section-browse .product .discount {
        color: red;
        font-weight: 600;
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
            <div class="address">
                <a href="index.php">Home</a>
                <p class="path">/ Jodhpuri</p>
            </div>
            <div class="section-browse">
                <?php
                // Loop through each jodhpuri product and display it
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product">';
                    echo '<a href="jodhpuri_product.php?product_id=' . $row['product_id'] . '">';
                    echo '<img src="' . $row['image_path'] . '" alt="Jodhpuri Image">';
                    echo '<p class="name">' . $row['description'] . '</p></a>';
                    echo '<p class="price"><span>';
                    echo '<span class="old-price">&#x20B9; ' . $row['old_price'] . '</span>';
                    echo '<span class="new-price">&#x20B9; ' . $row['new_price'] . '</span></span>';
                    echo '<span class="discount">' . $row['discount_percentage'] . '% off</span>';
                    echo '</p></div>';
                }
                ?>
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
                            class="guide-links">All India Delivery </a>
                    </li>
                    <li>
                        <div class="div-img"><img src="ICONS/whatsapp-50.png" alt=""></div><a href="#"
                            class="guide-links">Whatsapp Us </a>
                    </li>
                </ul>
            </div>
            <p>Copyright &copy Nikunj Fabrics & Bespoke Tailoring</p>
        </div>
    </footer>
</body>

</html>
<?php
mysqli_close($conn);
?>