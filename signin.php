<?php // signin php
include ("connection.php");
session_start();

if (isset($_POST['sign-in'])) {
    $userName = $_POST['username'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];

    // Validate that all fields are filled
    if (empty($userName) || empty($mobile) || empty($email)) {
        $_SESSION['status'] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['status'] = "Invalid email format.";
    } else {
        
        $conn = mysqli_connect($host, $user, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        // Check if the email already exists
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $_SESSION['status'] = "Email Already Exist";
            // echo "User Already Exist";
        } else {
            // Insert user data into the database
            $stmt = mysqli_prepare($conn, "INSERT INTO users (username, mobile, email) VALUES (?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "sss", $userName, $mobile, $email);

            if (mysqli_stmt_execute($stmt)) {
                // $_SESSION['status'] = "Registration successful.";
                header('location:login.php');
            } else {
                $_SESSION['status'] = "Registration failed: " . mysqli_error($conn);
            }
        }

        // Close the database connection
        mysqli_close($conn);
    }
}


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="main.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Cookie&family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"
    integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
<header class="sticky-top" style="background-color: #f5f5f5;">
    <nav class="navbar  navbar-expand-lg"
      style=" box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.3); height: 80px;">
      <div class="container-fluid">
        <a class="brand logo-container" href="./index.php"><img class="logo" src="./assets/logo_blazing.png" alt="" width="70" height="70"></a>
        <input class="search" type="search" value="" placeholder="search">
        <ul class="nav-list navbar-nav mb-2 mb-lg-0">
          <li class="nav-item"><a class="log-link" style="color: #000000;" href="./login.php"><i class="fa-regular fa-user nav-icon"></i>Login</a></li>
          <li class="nav-item"><a class="log-link" style="color: #000000;" href="#"><i class="fa-solid fa-cart-shopping nav-icon"></i>
            Cart</a></li>
          <li class="nav-item"><a class="log-link" style="color: #000000;" href="#"><i class="fa-regular fa-heart nav-icon"></i>
            Wishlist</a></li>
        </ul>
      </div>
    </nav>
  </header>
    <main>
    <div class="bg-img"></div>
    <section class="login-page">
        <div class="container">
            <div class="login-form">
                <div class="log-left">
                    <div class="log-head">
                        <h2>New User?</h2>
                        <p>Sign in with your mail id</p>
                    </div>
                    <div class="log-banner">
                        <img src="./assets/log_banner.png" alt="">
                    </div>
                </div>
                <div class="log-right">
                <form id="signin-form" method="POST" action="">
                    <input type="text" id="username" placeholder="User Name" name="username"><br>
                    <input type="text" id="phone" placeholder="mobile number" name="mobile">
                    <input type="email" id="email" placeholder="Enter email address" name="email"><br>
                    <div class="error-mail"></div>
                    <button class="signin-btn" type="submit" name="sign-in">Sign-In</button>
                </form>
                <div class="log-bottom"><a href="login.php">Existing User? Login</a></div>
                </div>
            </div>
        </div>
    </section>
    </div>
</main>
    <footer>
    <section class="footer">
      <div class="container-fluid">
        <div class="foot-content">
          <div class="footer-list">
            <h6>POLICY INFO</h6>
            <p>Privacy Policy</p>
            <p>Terms of Sale</p>
            <p>Terms of Use</p>
            <p>Report Abuse & Takedown Policy</p>
          </div>
          <div class="footer-list">
            <h6>COMPANY</h6>
            <p>About Us</p>
            <p>Core Values</p>
            <p>Careers</p>
            <p>Blog</p>
            <p>Sitemap</p>
          </div>
          <div class="footer-list">
            <h6>BLAZING BUSINESS</h6>
            <p>Shopping App</p>
            <p>Sell on BLAZING</p>
            <p>Advertise on BLAZING</p>
            <p>Media Enquiries</p>
            <p>Be an Affiliate</p>
          </div>
          <div class="footer-list">
            <h6>Need Help?</h6>
            <p>FAQ</p>
            <p>Contact Us</p>
            <p>online Shopping</p>
          </div>
          <div class="footer-list">
            <h6>SUBSCRIBE</h6>
            <input type="email" id="subscribe-box" name="email" placeholder="Your email address" />
            <button class="subscribe-but">Subscribe</button>
          </div>
        </div>
      </div>
    </section>
    <section class="foot-bottom">
      <div class="container-fluid">
        <div class="foot-Social">
          <h6>Copyright © All rights reserved</h6>
          <div class="social-media">
            <i class="fa-brands fa-x-twitter"></i>
            <i class="fa-brands fa-facebook smicon"></i>
            <i class="fa-brands fa-behance smicon"></i>
            <i class="fa-solid fa-earth-americas smicon"></i>
          </div>
        </div>
      </div>
    </section>
  </footer>

    <script>
        
    $(document).ready(function () {
        $("#signin-form").validate({
            rules: {
                username: {
                    required: true
                },
                mobile: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                username: {
                    required: "Please enter a username."
                },
                mobile: {
                    required: "Please enter a mobile number."
                },
                email: {
                    required: "Please enter an email address.",
                    email: "Please enter a valid email address."
                }
            },
        });
    });
</script>


   
</body>
</html>