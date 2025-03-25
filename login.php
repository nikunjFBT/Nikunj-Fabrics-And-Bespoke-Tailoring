<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nikunj Fabrics And Bespoke Tailoring/Login Page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="login.css">
    <style>
    .section-main .container {
        background-image: url(login_img.jpg);
        background-repeat: no-repeat;
        background-size: cover;
        padding-bottom: calc(2.7rem + 31vh);
    }

    .section-main .container::before {
        position: absolute;
        content: "";
        width: 100vw;
        height: 107vh;
        left: 0;
        top: 0;
        background-color: rgba(0, 0, 0, 0.629);
        z-index: -1;
    }
    </style>
</head>

<body>

    <?php
    session_start();

    // Database connection details
    $dsn = 'mysql:host=localhost;dbname=signup;charset=utf8';
    $username = 'root'; // Replace with your MySQL username
    $password = ''; // Replace with your MySQL password

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }

    $loginSuccess = false;
    $passwordIncorrect = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $loginSuccess = true;
            } else {
                $passwordIncorrect = true;
            }
        } else {
            echo "<script>alert('Invalid email or password.');</script>";
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
                    <li class="nav-list"><a href="aboutus.html" class="nav-link" id="about">ABOUT</a></li>
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
            <form action="login.php" method="post" class="form">
                <h2 class="form-header">LOGIN</h2>
                <div class="form-field">
                    <div class="field">
                        <input type="email" name="email" id="email" class="inp" placeholder="Email" required>
                    </div>
                    <div class="field">
                        <input type="password" name="password" id="password" class="inp" placeholder="Password"
                            required>
                        <p><input type="checkbox" class="checkbox" onclick="myfun()"> Show Password</p>
                        <a href="#" id="pswd">Forgot Password?</a>
                    </div>
                    <div class="field">
                        <button type="submit" class="btn">Login</button>
                    </div>
                    <div class="field">
                        <p>Don't Have An Account? <a href="signup.php">Sign Up</a></p>
                    </div>
                </div>
            </form>
            <div id="popup">
                <div class="message" id="popupMessage">You have Logged In Successfully !</div>
                <button class="action-btn" id="popupButton">DONE</button>
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
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($loginSuccess): ?>
        document.getElementById('popupMessage').textContent = 'You have Logged In Successfully !';
        document.getElementById('popupButton').textContent = 'DONE';
        document.getElementById('popupButton').onclick = function() {
            window.location.href = 'index.html';
        };
        document.getElementById('popup').classList.add('active');
        <?php elseif ($passwordIncorrect): ?>
        document.getElementById('popupMessage').textContent = 'Oops! Password Is Incorrect';
        document.getElementById('popupButton').textContent = 'TRY AGAIN';
        document.getElementById('popupButton').onclick = function() {
            document.location.href = 'login.php'; // Refresh the same page
        };
        document.getElementById('popup').classList.add('active');
        <?php endif; ?>
    });
    </script>
</body>

</html>