<?php // products.details.php
session_start();
include "./connection.php";

// Check if a product ID is provided in the URL
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Fetch details of the selected product
    $fetchProduct = "SELECT * FROM products WHERE product_id = $productId";
    $resultProduct = mysqli_query($conn, $fetchProduct);

    if ($rowProduct = mysqli_fetch_assoc($resultProduct)) {
        $productName = $rowProduct['product_title'];
        $productPrice = $rowProduct['product_price'];
        $productImage = $rowProduct['product_img'];

    } else {
        // Handle the case where no product is found
        echo "Product not found.";
        exit;
    }

    // Fetch products similar to the selected product
    $fetchSimilarProducts = "SELECT * FROM products WHERE category_id = {$rowProduct['category_id']} AND product_id != $productId LIMIT 7";
    $resultSimilarProducts = mysqli_query($conn, $fetchSimilarProducts);
} else {
    // Handle the case where no product ID is provided
    echo "No product selected.";
    exit;
}


?>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blazing</title>
  <link rel="stylesheet" href="main.css">

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"
    integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat&family=Oswald:wght@300;400&family=Poppins:wght@200;300;400;500;700&display=swap"
    rel="stylesheet">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>

    <?php include "./main-nav-bar.php";?>

  <a id="myBtn" onclick="topFunction()">
    <i class="fas fa-arrow-up"></i>
  </a>

  <main>
    <div class="porduct-Display">
      <div class="container">
        <div class="dis-prod">
          <div class="img-container">
            <img class="pro-img" id="myimage" src="./images/<?= $productImage ?>" alt="" onmouseover="imageZoom('myimage', 'myresult')" onmouseout="resetZoom()">
          </div>
          <div class="prod-dtls">
            <p class="prod-title"><?= $productName ?></p>
            <p class="prod-price">&#8377 <?= $productPrice ?></p>
            <div class="b-ad-btn">
                <form method="post" action="" class="form-submit">
                    <input type="hidden" class="pid" value=<?= $productId?>>
                    <input type="hidden" class="ptitle" value=<?= $productName?>>
                    <input type="hidden" class="pimage" value=<?= $productImage?>>
                    <input type="hidden" class="pprice" value=<?= $productPrice?>>
                    <button type="submit" class="buy" name="buy_now">Buy Now</button>
                    <button type="submit" class="ad-crt" id="addToCart" name="add_to_cart">Add to Cart</button>
                    <button type="button" class="go-to-cart" style="display: none;">Go to Cart</button>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="similar">
      <div class="container-fluid">
        <h2>Similar Products</h2>
        <div class="similar-products">
          <?php while ($rowSimilarProduct = mysqli_fetch_assoc($resultSimilarProducts)) : ?>
          <div class="card cards simlr-cards">
            <a class="cards-link" href="./products_details.php?product_id=<?= $rowSimilarProduct['product_id'] ?>"
              target="_blank">
              <!-- Include product ID in the URL and open in a new tab -->
              <div class="card-inner">
                <div class="c-img-container">
                  <img src="./images/<?= $rowSimilarProduct['product_img'] ?>" class="card-img-top card-img" alt="...">
                </div>
                <div class="card-body">
                  <p class="card-title truncate"><?= $rowSimilarProduct['product_title'] ?></p>
                  <p class="card-price">&#8377 <?= $rowSimilarProduct['product_price'] ?></p>
                </div>
              </div>
            </a>
          </div>
          <?php endwhile; ?>
        </div>
      </div>
    </section>
  </main>
  <div id="myresult" class="img-zoom-result"></div>
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

  <script type="text/javascript">
    $(document).ready(function(){
        var addToCartBtn = $("#addToCart");
        var goToCartBtn = $(".go-to-cart");

        addToCartBtn.click(function(e){
            e.preventDefault();
            var $form = $(this).closest(".form-submit");
            var pid = $form.find(".pid").val();
            var ptitle = $form.find(".ptitle").val();
            var pimage = $form.find(".pimage").val();
            var pprice = $form.find(".pprice").val();

            $.ajax({
                url: 'action.php',
                method: 'post',
                data: { pid:pid, ptitle:ptitle, pprice:pprice, pimage:pimage},
                success:function(response){
                    // Toggle button text
                    addToCartBtn.hide();
                    goToCartBtn.show();
                    // window.scrollTo(0,0);
                    loadCartQuantity();
                },
                error: function (error) {
                    // Handle the error response (optional)
                    console.error(error);
                }
            });
        });

        // Add event listener for "Go to Cart" button
        goToCartBtn.click(function() {
            window.location.href = 'cart-pg.php'; 
        });

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
    });
</script>



  <script>

    document.addEventListener("DOMContentLoaded", function () {
      // Get the gallery images and main product image element
      var galleryImages = document.querySelectorAll(".gallery-img");
      var mainProductImage = document.querySelector(".pro-img");

      // Add click event listeners to each gallery image
      galleryImages.forEach(function (galleryImage) {
        galleryImage.addEventListener("click", function () {
          // Change the source of the main product image to the clicked gallery image
          mainProductImage.src = galleryImage.src;
        });
      });
    });
  </script>


  <script src="index.js"></script>
</body>

</html>