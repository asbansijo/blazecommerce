 <?php 
include_once('connection.php');
session_start();


if(isset($_REQUEST['Verify_OTP'])) {
    $otp = $_REQUEST['otp'];
    $select_query = mysqli_query($conn, "SELECT * FROM users WHERE otp='$otp'");
    $count = mysqli_num_rows($select_query);
    $row = mysqli_fetch_assoc($select_query);

    if($count > 0) {
        // OTP is valid
        $user_email = $row['email'];
        $update_query = mysqli_query($conn, "UPDATE users SET otp='' WHERE email='$user_email'");

        // Determine the user's role from the database (assuming there is a 'role' column)
        $user_role = $row['role'];

        // Redirect based on the user's role
        if ($user_role == 'admin') {
            header('location: ./admin_panel/dashboard.html'); // Replace with the actual admin dashboard page
        } elseif ($user_role == 'user') {
            header('location: index.php'); // Replace with the actual user dashboard page
        } else {
            // Handle other roles or scenarios
            header('location: index.php'); // Default redirect
        }
    } else {
        $msg = "Invalid OTP!";
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
    <link
        href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Cookie&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
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
    <section class="login-page">
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
                    <p id="otp-descrip">Please enter the OTP sent to 9876546786</p>
                    <form class="otp-form" method="REQUEST" action="">
                        <div class="otp-field">
                            <input class="otp-box" type="text" maxlength="1" />
                            <input class="otp-box" type="text" maxlength="1" />
                            <input class="otp-box" type="text" maxlength="1" />
                            <input class="otp-box" type="text" maxlength="1" />
                            <input class="otp-box" type="text" maxlength="1" />
                            <input class="otp-box" type="text" maxlength="1" />
                        </div>
                        <input type="hidden" id="hidden-otp" name="otp" />
                        <button class="verify-btn" type="submit" name="Verify_OTP">Verify</button>
                    </form>
                </div>
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
    
    </section>
    </div>

    <script src="/script.js"></script>
    <script>
        const inputs = document.querySelectorAll(".otp-field input");
        const hiddenOtpInput = document.getElementById("hidden-otp");

        inputs.forEach((input, index) => {
            input.dataset.index = index;
            input.addEventListener("keyup", handleOtp);
            input.addEventListener("paste", handleOnPasteOtp);
        });

        function handleOtp(e) {

            const input = e.target;
            let value = input.value;
            let isValidInput = value.match(/[0-9]/gi);
            input.value = "";
            input.value = isValidInput ? value[0] : "";

            let fieldIndex = input.dataset.index;
            if (fieldIndex < inputs.length - 1 && isValidInput) {
                input.nextElementSibling.focus();
            }

            if (e.key === "Backspace" && fieldIndex > 0) {
                input.previousElementSibling.focus();
            }

            if (fieldIndex == inputs.length - 1 && isValidInput) {
                updateHiddenOTP();
            }
        }

        function handleOnPasteOtp(e) {
            const data = e.clipboardData.getData("text");
            const value = data.split("");
            if (value.length === inputs.length) {
                inputs.forEach((input, index) => (input.value = value[index]));
                updateHiddenOTP();
            }
        }

        function updateHiddenOTP() {
            let otp = "";
            inputs.forEach((input) => {
                otp += input.value;
            });
            hiddenOtpInput.value = otp;
            console.log("Hidden OTP Updated:", otp);
        }
    </script>

</body>

</html>