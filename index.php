<?php
include "./connection.php"; 


$sql = "SELECT * FROM category ORDER BY Id ASC";
$result = mysqli_query($conn, $sql);


?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Blazing</title>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"
    integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="main.css">
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

</head>

<body>
  <header class="sticky-top">
    <nav class="navbar  navbar-expand-lg"
      style="background-color: #f5f5f5; box-shadow: 0 2px 8px 0 rgba(0, 0, 0, 0.3); height: 80px;">
      <div class="container-fluid">
        <a class="brand" href="./index.php"><img class="logo" src="./assets/logo_blazing.png" alt="" width="70" height="70"></a>
        <input class="search" type="search" value="" placeholder="search">
        <ul class="nav-list navbar-nav mb-2 mb-lg-0">
        <li class="nav-item"><button style="background:#675fc3;padding: 5px 9px;border-radius: 4px;"><a class="log-link" style="color: #fbfbfb;" href="./login.php"><i class="fa-regular fa-user nav-icon"></i>Login</a></button></li>
          <li class="nav-item"><a class="log-link" style="color: #000000;" href="./cart-pg.php"><i class="fa-solid fa-cart-shopping nav-icon"></i>
            Cart</a></li>
          <li class="nav-item"><a class="log-link" style="color: #000000;" href="#"><i class="fa-regular fa-heart nav-icon"></i>
            Wishlist</a></li>
        </ul>
      </div>
    </nav>
  </header>
 
  <a id="myBtn" onclick="topFunction()">
        <i class="fas fa-arrow-up"></i>
  </a>
  <main>
    <!-- Categories -->
    <section class="categories">
  <div class="container-fluid">
    <div class="category-tab">
      <?php
      $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
      foreach ($rows as $row) {?>
      <div class="category">
        <div class="ct-img-container">
          <img class="cat-img img-fluid" src="./images/<?= $row['category_image']?>" alt="">
        </div>
        <h3 class="category-name">
          <a href="./products-pg.php?category_id=<?php echo $row['Id']; ?>"><?php echo $row['category_name']?></a>
        </h3>
      </div>
      <?php }?>
    </div>
  </div>
</section>

    <!-- Landing page Carousel-->
    <section class="carousel carousel-bg">
      <div class="container-fluid">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
              aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
              aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
              aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner carous-inn">
            <div class="carousel-item active">
              <div class="content-split">
                <div class="car-img-container">
                  <img src="./product_img/apple12.png" class="carouse-img w-100" alt="...">
                </div>
                <div class="banner-content">
                  <h2 class="banner-head">Iphone 12 pro</h2>
                  <button class="banner-btn">Shop now</button>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="content-split">
                <div class="car-img-container">
                  <img src="./product_img/canon-camera-png-hd.png" class="carouse-img w-100" alt="...">
                </div>
                <div class="banner-content">
                  <h2 class="banner-head">Canon EOS 6D</h2>
                  <button class="banner-btn">Shop now</button>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="content-split">
                <div class="car-img-container">
                  <img src="./product_img/macbook.png" class="carouse-img w-100" alt="...">
                </div>
                <div class="banner-content">
                  <h2 class="banner-head">MacBook pro</h2>
                  <button class="banner-btn">Shop now</button>
                </div>
              </div>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
    </section>
    <!-- Landing Page Cards for Best Products -->
    <section class="best-deals">
      <div class="container-fluid">
        <div class="cards-tab">
          <h5 class="deals-head">Best Mobile</h5>
          <div class="cards-tab-inner">
            <div class="card cards">
              <a class="cards-link" href="./products_details.html">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/s22-ultra.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Samsung Galaxy S22 ultra</p>
                    <p class="card-price">&#8377 80,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="./products_details.html">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/macbook.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Iphone 15pro max</p>
                    <p class="card-price">&#8377 1,50,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/Samsung-Galaxy-PNG-Clipart.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Samsung Galaxy S21</p>
                    <p class="card-price">&#8377 30,999</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/vivo_x90.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Vivo X90</p>
                    <p class="card-price">&#8377 60,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/moto_razr_40_ultra-2.webp" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Motorola razr 40 ultra</p>
                    <p class="card-price">&#8377 65,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/Google-Pixel-6a.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Google pixel 6a</p>
                    <p class="card-price">&#8377 32,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/mi-note-12-pro.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Redmi Note 12 pro+ 5G</p>
                    <p class="card-price">&#8377 40,000</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="offer">
      <div class="container-fluid">
        <a href="">
          <div>
            <img src="./product_img/offer1.jpg" class="off-ban-img" alt="">
          </div>
        </a>
      </div>
    </section>

    <section class="best-products">
      <div class="container-fluid">
        <div class="cards-tab">
          <h5 class="deals-head">Best Products</h5>
          <div class="cards-tab-inner">
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/s22-ultra.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Samsung Galaxy S22 ultra</p>
                    <p class="card-price">&#8377 80,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/15-pro-max.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Iphone 15pro max</p>
                    <p class="card-price">&#8377 1,50,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/Samsung-Galaxy-PNG-Clipart.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Samsung Galaxy S21</p>
                    <p class="card-price">&#8377 30,999</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/vivo_x90.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Vivo X90</p>
                    <p class="card-price">&#8377 60,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/moto_razr_40_ultra-2.webp" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Motorola razr 40 ultra</p>
                    <p class="card-price">&#8377 65,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/Google-Pixel-6a.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Google pixel 6a</p>
                    <p class="card-price">&#8377 32,000</p>
                  </div>
                </div>
              </a>
            </div>
            <div class="card cards">
              <a class="cards-link" href="#">
                <div class="card-inner">
                  <div class="c-img-container">
                    <img src="./product_img/mi-note-12-pro.png" class="card-img-top card-img" alt="...">
                  </div>
                  <div class="card-body">
                    <p class="card-title">Redmi Note 12 pro+ 5G</p>
                    <p class="card-price">&#8377 40,000</p>
                  </div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>


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
  <script src="index.js"></script>
</body>

</html>