<?php
// Start session if needed for the custom order
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custom Order</title>
    <link rel="stylesheet" href="style.css"> <!-- Keeping global styles here -->
    <style>
        /* Custom styles for the custom order form */
        .custom-order-container {
            width: 80%;
            margin: 0 auto;
            padding: 2rem;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin-top: 3rem;
            margin-bottom: 2.7rem;
        }

        .custom-order-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            color: #333;
            font-family: 'Urbanist', sans-serif;
            font-weight: 500;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-size: 1.5rem;
            color: black;
            margin-bottom: 0.5rem;
            font-family: 'Urbanist', sans-serif;
            font-weight: 500;
            color: black;
        }

        .form-group input, .form-group select, .form-group textarea {
            padding: 0.75rem;
            font-size: 1.5rem;
            border: 1px solid #ccc;
            /* border-radius: 5px; */
            transition: border-color 0.3s;
            font-family: 'Urbanist', sans-serif;
        }

        .form-group input:focus, .form-group select:focus, .form-group textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        .form-group textarea {
            resize: vertical;
            height: 150px;
        }

        .custom-order-submit {
            width: 100%;
            height: 60px;
            padding: 1rem;
            background-color: #007bff;
            color: white;
            font-size: 2rem;
            font-family: 'Urbanist', sans-serif;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .custom-order-submit:hover {
            background-color: #0074e7;
        }

        .form-row {
            display: flex;
            justify-content: space-between;
            gap: 2rem;
        }

        .form-row .form-group {
            flex: 1;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
            }
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
                <li class="nav-list"><a href="index.php" class="nav-link">HOME</a></li>
                <li class="nav-list" id="collections"><a href="#" class="nav-link">COLLECTIONS</a>
                    <ul class="popup">
                        <li><a href="kurta.php">Kurta</a></li>
                        <li><a href="sherwani.php">Sherwani</a></li>
                        <li><a href="jodhpuri.php">Jodhpuri</a></li>
                        <li><a href="suit.php">Suit</a></li>
                        <li><a href="#">Formal</a></li>
                    </ul>
                </li>
                <li class="nav-list"><a href="#" class="nav-link" id="about">ABOUT</a></li>
            </ul>
        </div>
        <div class="cart">
            <ul>
                <li class="cart"><a href="login.php"><img src="ICONS/account-50.png" alt="Account" class="icon"></a></li>
                <li class="cart"><a href="cart.php"><img src="ICONS/shopping-bag-50.png" alt="Shopping Bag" class="icon"></a></li>
            </ul>
        </div>
    </div>
</header>

<main class="section-main">
<div class="container">
    <div class="custom-order-container">
        <h2 class="custom-order-title">Place Your Custom Order</h2>
        <form action="process_custom_order.php" method="POST">
            <!-- Customer Information -->
            <div class="form-row">
                <div class="form-group">
                    <label for="full_name">Full Name</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="text" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="order_type">Order Type</label>
                    <select id="order_type" name="order_type" required>
                        <option value="">Select</option>
                        <option value="kurta">Kurta</option>
                        <option value="sherwani">Sherwani</option>
                        <option value="jodhpuri">Jodhpuri</option>
                        <option value="suit">Suit</option>
                        <option value="other">Other</option>
                    </select>
                </div>
            </div>

            <!-- Measurements -->
            <div class="form-group">
                <label for="measurements">Provide Your Measurements</label>
                <textarea id="measurements" name="measurements" placeholder="Provide height, chest, waist, and other necessary measurements" required></textarea>
            </div>

            <!-- Delivery Date -->
            <div class="form-group">
                <label for="delivery_date">Preferred Delivery Date</label>
                <input type="date" id="delivery_date" name="delivery_date" required>
            </div>

            <!-- Additional Notes -->
            <div class="form-group">
                <label for="notes">Additional Notes</label>
                <textarea id="notes" name="notes" placeholder="Any specific customizations or preferences?"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="custom-order-submit">Submit Custom Order</button>
        </form>
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
                <li><a href="#" class="social-links" id="insta"><img src="ICONS/instagram.png" alt="">Instagram </a></li>
                <li><a href="#" class="social-links" id="twt"><img src="ICONS/twitter.png" alt="">Twitter </a></li>
            </ul>
        </div>
        <div class="guide">
            <ul>
                <li><div class="div-img"><img src="ICONS/mguide-book-50.png" alt=""></div><a href="#" class="guide-links">Measurement Guide </a></li>
                <li><div class="div-img"><img src="ICONS/sewing-machine-50.png" alt=""></div><a href="custom_order.php" class="guide-links">Custom Order </a></li>
                <li><div class="div-img"><img src="ICONS/all_india_delivery-50.png" alt=""></div><a href="#" class="guide-links">All India Delivery </a></li>
                <li><div class="div-img"><img src="ICONS/whatsapp-50.png" alt=""></div><a href="#" class="guide-links">Whatsapp Us </a></li>
            </ul>
        </div>
        <p>Copyright &copy Nikunj Fabrics & Bespoke Tailoring</p>
    </div>
</footer>
</body>
</html>
