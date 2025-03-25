<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nikunj Fabrics And Bespoke Tailoring/Signup Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
</head>

<body>

    <?php
    session_start();

    // Database connection details
    $dsn = 'mysql:host=localhost;dbname=signup;charset=utf8';
    $username = 'root'; // Replace with your MySQL username
    $password = ''; // Replace with your MySQL password

    try {
        // Create a PDO instance
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }

    $signupSuccess = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Check if the email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('Email already registered.');</script>";
        } else {
            // Insert new user into the database
            $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)");
            $stmt->bindParam(':first_name', $firstName);
            $stmt->bindParam(':last_name', $lastName);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);

            if ($stmt->execute()) {
                $signupSuccess = true;  // Set signup success flag
            } else {
                echo "<script>alert('Signup failed. Please try again.');</script>";
            }
        }
    }
    ?>

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
                    <li class="nav-list"><a href="#" class="nav-link" id="about">ABOUT</a></li>
                </ul>
            </div>
            <div class="cart">
                <div class="cart">
                    <ul>
                        <!-- <li class="cart"><img src="ICONS/BLK/search_24dp_000000_FILL0_wght400_GRAD0_opsz24.png" alt="Search" class="icon" id="search"></li> -->
                        <li class="cart"><a href="login.php"><img src="ICONS/account-50.png" alt="Account"
                                    class="icon"></a></li>
                        <li class="cart"><a href="cart.php"><img src="ICONS/shopping-bag-50.png" alt="Shopping Bag"
                                    class="icon"></a></li>
                    </ul>
                </div>
            </div>
    </header>

    <main class="section-main">
        <div class="container">
            <form action="signup.php" method="post" class="form">
                <h2 class="form-header">SIGN UP</h2>
                <div class="form-field">
                    <div class="field">
                        <input type="text" name="first_name" id="fn" class="inp" placeholder="First Name" required>
                    </div>
                    <div class="field">
                        <input type="text" name="last_name" id="ln" class="inp" placeholder="Last Name" required>
                    </div>
                    <div class="field">
                        <input type="email" name="email" id="email" class="inp" placeholder="Email" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" id="password" class="inp" placeholder="Create Password"
                            required>
                    </div>
                    <div class="field">
                        <input type="password" id="password1" class="inp" placeholder="Confirm Password" required>
                        <p><input type="checkbox" class="checkbox" onclick="myfun()"> Show Password</p>
                    </div>
                    <div class="field">
                        <button type="submit" class="btn">Sign Up</button>
                    </div>
                    <div class="field" class="form-link">
                        <p>Already Have An Account? <a href="login.php">Login</a></p>
                    </div>
                </div>
            </form>
            <div id="popup">
                <div class="message" id="popupMessage">Signup Successful</div>
                <button class="action-btn" id="popupButton" onclick="window.location.href='login.php'">DONE</button>
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
    <script>
    function myfun() {
        var x = document.getElementById("password");
        var y = document.getElementById("password1");
        if (x.type === "password" && y.type === "password") {
            x.type = "text";
            y.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
        }
    }
    <?php if ($signupSuccess): ?>
    // Show the popup after successful signup
    document.getElementById('popup').classList.add('active');
    <?php endif; ?>
    </script>
</body>

</html>