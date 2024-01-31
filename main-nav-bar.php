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
<header class="sticky-top" style="background-color: #675fc3;">

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
                <span class="cart_count"></span>
                <i class="fa-solid fa-cart-shopping nav-icon"></i>
                Cart</a>
            </li>
            <li class="nav-item"><a class="log-link" href="#"><i class="fa-regular fa-heart nav-icon"></i>
                Wishlist</a></li>
          </ul>
        </div>
      </nav>
      </header>
      <div class="sub_nav">
        <div class="inner-sub-nav">
        <?php
             $categories = mysqli_query($conn, "SELECT * FROM category");
             while($row = mysqli_fetch_array($categories)){
        ?>
        <!-- <p class="category-name"> -->
          <a class="category-name" href="./products-pg.php?category_id=<?php echo $row['Id']; ?>"><?php echo $row['category_name']?></a>
        <!-- </p> -->
        <?php }?>
        </div>
      </div>
      
      <script type="text/javascript">
      loadCartQuantity();

      function loadCartQuantity(){
        $.ajax({
          url:'action.php',
          method: 'get',
          data: {cartCount:"cartCount"}, 
          success: function(response){
            $(".cart_count").html(response); 
          }
        });
      }
</script>
<script src="index.js"></script>
</body>
</html>
