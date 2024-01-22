<?php  //login php
session_start();
include_once ('connection.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if(isset($_REQUEST['Login'])) {
    $email = $_REQUEST['email'];
    $select_query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $res = mysqli_num_rows($select_query);
    
    if($res > 0) {
        $data = mysqli_fetch_array($select_query);

        $otp = rand(100000, 999999); // Generate OTP

        $message = '<div>
            <p><b>Login OTP</b></p>
            <p>You are receiving this email for OTP to Login with us .</p>
            <br>
            <p>Your OTP is: <b>'.$otp.'</b></p>
            <br>
            <p>If you did not request OTP, Please ignore.</p>
            <br>
            <p>Please Do not Share Your OTP.</p>
        </div>';

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->Username = 'asban.sijo@gmail.com'; // Replace with your Gmail email
            $mail->Password = 'xbjm fcqf mmrh felc'; // Replace with your Gmail password
            $mail->setFrom('asban.sijo@gmail.com', 'Asban Sijo'); // Replace with your name
            $mail->addAddress($email);
            $mail->Subject = "OTP";
            $mail->isHTML(true);
            $mail->Body = $message;
            
            if($mail->send()) {
                $insert_query = mysqli_query($conn, "UPDATE users SET otp='$otp' WHERE email='$email'");
                $_SESSION['emails'] = $email;
                header('location: otp.php');
            } else {
                $msg = "Email not delivered";
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        $msg = "Invalid user";
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
    <!-- <div class="bg-img"></div> -->
    <section class="login-page">
        <div class="container">
            <div class="login-form">
                <div class="log-left">
                    <div class="log-head">
                        <h2>LOGIN</h2>
                        <p>Get way in to your Orders, Cart, Wishlist..</p>
                    </div>
                    <div class="log-banner">
                        <img src="./assets/log_banner.png" alt="">
                    </div>
                </div>
                <div class="log-right">
                <form id="login-form" method="POST" action="">
                    <input type="text" id="email" placeholder="Enter Email/Mobile Number" name="email"><br>
                    <div class="error-mail"></div>
                    <button id="login-btn" type="submit" name="Login">Request OTP</button>
                </form>
                <div class="log-bottom"><a href="signin.php">New User? Create account</a></div>
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
        $("#login-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                }
            },
            messages: {
                email: {
                    required: "Please enter an email address.",
                    email: "Please enter a valid email address."
                }
            }
        });
    });
</script>
    
</body>
</html>