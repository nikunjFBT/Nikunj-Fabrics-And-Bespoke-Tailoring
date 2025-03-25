<?php
// Connect to the database
$connection = new mysqli('localhost', 'root', '', 'product_catalog');

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Fetch product details from the database
$sql = "SELECT * FROM kurta";
$result = $connection->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kurta Section</title>
    <link rel="stylesheet" href="style.css">
    <style>
    body {
        font-family: urbanist;
    }

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
        z-index: 5;
    }

    .section-main .container .section-browse .product a .image {
        width: 36rem;
        height: 451.33px;
        position: relative;
    }

    .section-main .container .section-browse .product a .image img {
        position: absolute;
        width: 36rem;
        left: 0;
        top: 0;
        z-index: -1;
    }

    .section-main .container .section-browse .product .name {
        padding-top: 3px;
        font-weight: 400;
        font-size: 1.8rem;
        word-spacing: 0.5rem;
        margin-bottom: 0.5rem;
        background-color: white;
    }

    .section-main .container .section-browse .product .price {
        font-size: 1.8rem;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-color: white;
        z-index: 5;
    }

    .section-main .container .section-browse .product .price .price-div {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        background-color: white;
        padding-bottom: 0.5rem;
    }

    .section-main .container .section-browse .product .price span {
        background-color: white;
    }

    .section-main .container .section-browse .product .old-price {
        font-size: 1.8rem;
        font-weight: 600;
        color: rgb(156 156 156);
        text-decoration: line-through;
        margin-right: 2rem;
    }

    .section-main .container .section-browse .product .new-price {
        font-size: 1.8rem;
        font-weight: 600;
        color: black;
    }

    .section-main .container .section-browse .product .discount {
        font-size: 1.8rem;
        font-weight: 600;
        color: red;
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
                            <li><a href="#">Jodhpuri</a></li>
                            <li><a href="#">Suit</a></li>
                            <li><a href="#">Formal</a></li>
                        </ul>
                    </li>
                    <li class="nav-list"><a href="aboutus.html" class="nav-link" id="about">ABOUT</a></li>
                </ul>
            </div>
            <div class="cart">
                <ul>
                    <!-- <li class="cart"><img src="ICONS/BLK/search_24dp_000000_FILL0_wght400_GRAD0_opsz24.png" alt="Search" class="icon" id="search"></li> -->
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
                <p class="path">/ Kurta</p>
            </div>
            <div class="section-browse">
                <?php
                // Display products dynamically
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // For each product, create a div with product details
                        echo '
                        <div class="product">
                            <a href="kurta_product.php?product_id=' . $row["product_id"] . '">
                                <div class="image">
                                    <img src="' . $row["image_path"] . '" alt="Picture">
                                </div>
                            </a>
                            <div class="price">
                                <a href="kurta_product.php?product_id=' . $row["product_id"] . '">
                                    <p class="name">' . $row["description"] . '</p>
                                </a>
                                <div class="price-div">
                                <span>
                                    <span class="old-price">&#x20B9; ' . $row["old_price"] . '</span>
                                    <span class="new-price">&#x20B9; ' . $row["new_price"] . '</span>
                                </span>
                                <span class="discount">' . $row["discount_percentage"] . '% off</span>
                                </div>
                            </div>
                        </div>';
                    }
                } else {
                    echo "<p>No products found</p>";
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
$connection->close();
?>