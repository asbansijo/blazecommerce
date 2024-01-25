<?php // products.php
include "./connection.php"; 

// Check if a category ID is provided in the URL
if (isset($_GET['category_id'])) {
    $categoryId = $_GET['category_id'];

    // Use the category ID to filter and fetch products from the selected category
    $fetch = "SELECT * FROM products WHERE category_id = $categoryId ORDER BY product_id ASC";
    $result = mysqli_query($conn, $fetch);

} else {
    // Handle the case where no category ID is provided
    echo "No category selected.";
}
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
    <header class="sticky-top" style="background-color: #675fc3;">
        <?php include "./main-nav-bar.php";?>
    </header>
    <a id="myBtn" onclick="topFunction()">
        <i class="fas fa-arrow-up"></i>
    </a>
    <main>
        <div class="product-pg">
            <div class="container-fluid">
                <div class="product-pg-inner" style="display: flex;">
                    <div class="side-bar">
                        <div class="container">
                            <p class="filters">Filters</p>
                            <hr>
                        </div>
                    </div>
                    <!-- products -->
                    <div class="prod-mobile">
                        <?php
                        // Display products dynamically
                        while ($row = mysqli_fetch_assoc($result)) {
                            $productId = $row['product_id'];
                            $productName = $row['product_title'];
                            $productPrice = $row['product_price'];
                            $productImage = $row['product_img'];
                        ?>
                        <div class="card cards">
                            <a class="cards-link" href="./products_details.php?product_id=<?= $productId ?>"
                                target="_blank">
                                <!-- Include product ID in the URL and open in a new tab -->
                                <div class="card-inner">
                                    <div class="c-img-container">
                                        <img src="./images/<?= $productImage ?>" class="card-img-top card-img"
                                            alt="...">
                                    </div>
                                    <div class="card-body">
                                        <p class="card-title truncate"><?= $productName ?></p>
                                        <p class="card-price">&#8377 <?= $productPrice ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
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
    <!-- <script src="index.js"> -->
    </script>
</body>

</html>