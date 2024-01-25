<!-- nav-bar -->
<?php
include "./connection.php"; 

$userID = isset($_SESSION['id']) ? $_SESSION['id'] : null; 

// Check if the user is logged in
if ($userID) {
    $query = "SELECT username FROM users WHERE id = $userID"; 
    $result = mysqli_query($connection, $query);
    $userData = mysqli_fetch_assoc($result);
    $username = $userData['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
    <nav class="navbar  navbar-expand-lg" style=" box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.3); height: 80px;">
        <div class="container-fluid">
          <a class="brand logo-container" href="./index.php"><img class="logo" src="./assets/logo_blazing.png" alt=""
              width="70" height="70"></a>
          <input class="search" type="search" value="" placeholder="search">
          <ul class="nav-list navbar-nav mb-2 mb-lg-0">
            <?php if ($userID): ?>
                <li class="nav-item"><span class="log-link">Welcome, <?php echo $username; ?>!</span></li>
            <?php else: ?>
                <li class="nav-item"><a class="log-link" href="./login.php"><i class="fa-regular fa-user nav-icon"></i>Login</a></li>
            <?php endif; ?>
            <li class="nav-item">
              <a class="log-link" href="./cart-pg.php" target="_blank">
                <span class="cart-count">0</span>
                <i class="fa-solid fa-cart-shopping nav-icon"></i>
                Cart</a>
            </li>
            <li class="nav-item"><a class="log-link" href="#"><i class="fa-regular fa-heart nav-icon"></i>
                Wishlist</a></li>
          </ul>
        </div>
      </nav>
    
</body>
</html>
