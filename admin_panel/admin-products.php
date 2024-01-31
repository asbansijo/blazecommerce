<?php //adminproducts.page
session_start();
require_once "navbar.html";
require_once "sidebar.html";
include "../connection.php";

// Inserting product
if (isset($_POST['add-product']) ) {
    $productName = $_POST['product_title'];
    $productPrice = $_POST['product_price'];
    $productBrand = $_POST['brand'];
    $productDescrip = $_POST['product_description'];
    $productDetails = $_POST['product_details'];
    $categoryId = $_POST['category_id']; 
    
    $imageName = $_FILES['product_img']['name'];
    $imageSize = $_FILES['product_img']['size'];
    $tmp_name = $_FILES['product_img']['tmp_name'];
    $error = $_FILES['product_img']['error'];

    if ($error === 0) {
        if ($imageSize > 1250000) {
            $_SESSION['status'] = "File is Too Big.";
        } else {
            $imageExt = pathinfo($imageName, PATHINFO_EXTENSION);
            $imageActExt = strtolower($imageExt);

            $allowedExts = array("jpeg", "png", "jpg");
            if (in_array($imageActExt, $allowedExts)) {
                $newImageName = uniqid();
                $newImageName .= '.' . $imageActExt;
                $proImage_path = '../images/' . $newImageName;
                move_uploaded_file($tmp_name, $proImage_path); 

                $stmt = $conn->prepare("INSERT INTO products (product_title, product_img, brand, product_price, product_description, product_details, category_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssssi", $productName, $proImage_path, $productBrand, $productPrice, $productDescrip, $productDetails, $categoryId);
                

                $stmt->execute();
                if ($stmt->affected_rows > 0) {                
                    $_SESSION['status'] = "Product added successfully.";
                } else {
                    $_SESSION['status'] = "Error inserting product: " . $stmt->error;
                }

                $stmt->close();
            }
        }
    }
}

// Read - Fetch Products
$fetch = "SELECT * FROM products ORDER BY product_id ASC";
$result = mysqli_query($conn, $fetch);

// Read - Fetch Products based on Category
if (isset($_GET['category_id'])) {
    $categoryIdFilter = $_GET['category_id'];
    $fetch = "SELECT * FROM products WHERE category_id = $categoryIdFilter ORDER BY product_id ASC";
} else {
    $fetch = "SELECT * FROM products ORDER BY product_id ASC";
}

$result = mysqli_query($conn, $fetch);



// Edit - Update Product
if (isset($_POST['edit-product'])) {
    $productId = $_POST['edit-product-id']; // Assuming you have an input field for product_id in the edit form

    // Retrieve other updated details
    $productName = $_POST['product_title'];
    $productPrice = $_POST['product_price'];
    $productBrand = $_POST['brand'];
    $productDescrip = $_POST['product_description'];
    $productDetails = $_POST['product_details'];
    $categoryId = $_POST['category_id'];

    // Handle image upload if a new image is selected
    if ($_FILES['product_img']['size'] > 0) {
        // Check if there are no errors during file upload
        if ($_FILES['product_img']['error'] == 0) {
            $imageFileName = $_FILES['product_img']['name'];
            $imageTempPath = $_FILES['product_img']['tmp_name'];
            $imageUploadPath = "../images/" . $imageFileName;

            // Move the uploaded file to the desired location
            move_uploaded_file($imageTempPath, $imageUploadPath);

            // Update the product image in the database
            $stmt = $conn->prepare("UPDATE products SET product_img=? WHERE product_id=?");
            $stmt->bind_param("si", $imageFileName, $productId);
            $stmt->execute();
            $stmt->close();
        } else {
            $_SESSION['status'] = "Error uploading image: " . $_FILES['product_img']['error'];
            // Handle the error as needed
        }
    }

    // Update the other product details in the database
    $stmt = $conn->prepare("UPDATE products SET product_title=?, product_price=?, brand=?, product_description=?, product_details=?, category_id=? WHERE product_id=?");
    $stmt->bind_param("sssssii", $productName, $productPrice, $productBrand, $productDescrip, $productDetails, $categoryId, $productId);

    $stmt->execute();
    if ($stmt->affected_rows > 0) {
        $_SESSION['status'] = "Product updated successfully.";
    } else {
        $_SESSION['status'] = "Error updating product: " . $stmt->error;
    }

    $stmt->close();
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bruno+Ace+SC&family=Cookie&family=Poppins:wght@400;500&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <div id="header"></div>
    </header>
    <main>
        <!-- side-bar -->
        <div id="side-bar"></div>

        <section class="dash-panel">
            <div class="dash-container">
                <div class="dashboard">
                    <h1 class="dash-head">All Products</h1>
                    <div class="btn-split">
                        <div class="category-dropdown">
                            <button class="category-list-btn">Select Category<span
                                    class="material-symbols-outlined">expand_more</span></button>
                            <!-- Category Dropdown Menu -->
                            <section class="category-dropdown-menu">
                                <?php
                                $categories = mysqli_query($conn, "SELECT * FROM category");
                                while($c = mysqli_fetch_array($categories)){
                                ?>
                                <button class="category-dropdown-option" id="all-prod" value="<?php echo $c['Id']?>"
                                    onclick="filterByCategory(<?php echo $c['Id']?>)">
                                    <?php echo $c['category_name']?>
                                </button>
                                <?php } ?>
                            </section>
                        </div>

                        <!-- ----- adding product ----- -->

                        <button class="add-product">ADD PRODUCT<span class="material-symbols-outlined">
                                add
                            </span></button>
                    </div>

                    <!-- Product Adding Modal -->
                    <div class="modal" id="add-prod-modal">
                        <div class="bg-blur"></div>
                        <div class="product-modal">
                            <h2>ADD Product</h2>
                            <span class="prod-close">&times;</span>
                            <form action="admin-products.php" method="POST" enctype="multipart/form-data">
                                <div class="left">
                                    <div class="upload-img-container prod-img" id="prod-add-preview">
                                        <label id="img-upload-lable" for="product-img-input">
                                            <span class="material-symbols-outlined add-photo">
                                                add_a_photo
                                            </span>
                                            <p>Upload an Image</p>
                                        </label>
                                    </div>
                                    <input type="file" name="product_img" id="product-img-input" accept="">
                                </div>
                                <div class="right prod-inputs">
                                    <input type="text" name="product_title" placeholder="Product Name">
                                    <input type="text" name="product_price" placeholder="Product Price">
                                    <input type="text" name="brand" placeholder="Enter Brand">
                                    <select name="category_id" id="select-cat">
                                        <option value="">Select Category</option>
                                        <?php
                                          $categories = mysqli_query($conn, "SELECT * FROM category");
                                          while($c = mysqli_fetch_array($categories)){
                                        ?>
                                        <option id="cat-option" value="<?php echo $c['Id']?>">
                                            <?php echo $c['category_name']?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="text" name="product_description" placeholder="Product Description">
                                    <input type="text" name="product_details" placeholder="Product Details">
                                    <button class="add prod-add" type="submit" name="add-product">
                                        <div id="circle" class="circle"></div>ADD
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Edit Product Modal -->
                    <div class="modal" id="edit-prod-modal">
                        <div class="bg-blur"></div>
                        <div class="product-modal">
                            <h2>Edit Product</h2>
                            <span class="edit-prod-close">&times;</span>
                            <form action="admin-products.php" method="POST" enctype="multipart/form-data">
                                <div class="left">
                                    <div class="upload-img-container prod-img" id="prod-edit-preview">
                                        <label id="img-upload-lable" for="edit-product-img">
                                            <span class="material-symbols-outlined add-photo">
                                                add_a_photo
                                            </span>
                                            <p>Upload an Image</p>
                                        </label>
                                        <img id="edit-preview-image" src="" alt="Product Image Preview">
                                    </div>
                                    <input type="file" name="product_img" id="edit-product-img" accept="">
                                </div>
                                <div class="right prod-inputs">
                                    <input type="hidden" name="edit-product-id" id="edit-product-id">
                                    <input type="text" name="product_title" id="edit-product-title"
                                        placeholder="Product Name">
                                    <input type="text" name="product_price" id="edit-product-price"
                                        placeholder="Product Price">
                                    <input type="text" name="brand" id="edit-brand" placeholder="Enter Brand">
                                    <select name="category_id" id="select-cat-edit">
                                        <option value="">Select Category</option>
                                        <?php
                                            $categories = mysqli_query($conn, "SELECT * FROM category");
                                            while ($c = mysqli_fetch_array($categories)) {
                                        ?>
                                        <option id="cat-option" value="<?php echo $c['Id'] ?>">
                                            <?php echo $c['category_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <input type="text" name="product_description" id="edit-product-description"
                                        placeholder="Product Description">
                                    <input type="text" name="product_details" id="edit-product-details"
                                        placeholder="Product Details">
                                    <button class="add prod-add" type="submit" name="edit-product">
                                        <div id="circle" class="circle"></div>EDIT
                                    </button>
                                </div>
                                <label for="sub-images">
                                    <p>Upload Sub-Images</p>
                                </label>
                                <input id="sub-images" type="file" style="display: none">
                            </form>
                        </div>
                    </div>

                    <!-- Product Table -->
                    <div class="dtl-table product-tab">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Id</th>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while($row = mysqli_fetch_array($result)){
                                ?>
                                <tr>
                                    <td><?= $row['product_id']?></td>
                                    <td class="p-img-row">
                                        <!--<div class="bg-p-img">--><img class="prod-image"
                                            src="../images/<?= $row['product_img']?>" alt="Product Image">
                                        <!--</div>-->
                                    </td>
                                    <td><?php echo $row['product_title']?></td>
                                    <td><?= $row['product_price']?></td>
                                    <td>
                                        <button class="edit-product" data-product-id="<?= $row['product_id'] ?>"
                                            data-product-img="<?= $row['product_img'] ?>"
                                            data-product-brand="<?= $row['brand'] ?>"
                                            data-product-title="<?= $row['product_title'] ?>"
                                            data-product-price="<?= $row['product_price'] ?>"
                                            data-category-id="<?= $row['category_id'] ?>"
                                            data-product-description="<?= $row['product_description'] ?>"
                                            data-product-details="<?= $row['product_details'] ?>">Edit</button>
                                    </td>
                                    <td><button class="delete-product"
                                            data-product-id="<?= $row['product_id'] ?>">Delete</button></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        function filterByCategory(categoryId) {
            window.location.href = 'admin-products.php?category_id=' + categoryId;
        }

        $(document).ready(function () {
            $(".edit-product").on("click", function () {
                var productId = $(this).data("product-id");
                var productImg = $(this).data("product-img");
                var productBrand = $(this).data("product-brand");
                var productTitle = $(this).data("product-title");
                var productPrice = $(this).data("product-price");
                var categoryId = $(this).data("category-id");
                var productDescription = $(this).data("product-description");
                var productDetails = $(this).data("product-details");

                $("#edit-product-id").val(productId);
                $("#edit-product-title").val(productTitle);
                $("#edit-product-price").val(productPrice);
                $("#select-cat-edit").val(categoryId);
                $("#edit-brand").val(productBrand);
                $("#edit-product-description").val(productDescription);
                $("#edit-product-details").val(productDetails);
                $("#edit-preview-image").attr("src", "../images/" + productImg);

                $("#edit-prod-modal").show();

                $(".edit-prod-close").on("click", function () {
                    $("#edit-prod-modal").hide();
                });
            });
        });



        $(document).ready(function () {
            // AJAX call for deleting a product
            $(".delete-product").on("click", function () {
                var productId = $(this).data("product-id");
                if (confirm('Are you sure you want to delete this Product?')) {
                    $.ajax({
                        type: "POST",
                        url: "delete.php",
                        data: {
                            product_id: productId
                        },
                        success: function (response) {
                            if (response) {
                                location.reload();
                            } else {
                                // $(this).closest("tr").remove();
                                alert("Error deleting product.");
                            }
                        },
                        error: function () {
                            alert("Error deleting product. Please try again.");
                        }
                    });
                }
            });
        });



        // product modal image preview

        document.addEventListener("DOMContentLoaded", function () {
            function handleFileInputChange(event, prodImagePreview) {
                const file = event.target.files[0];
                if (file) {
                    const productReader = new FileReader();

                    productReader.addEventListener('load', function () {
                        const productImage = new Image();

                        productImage.src = this.result;
                        productImage.addEventListener('load', function () {
                            const ratio = Math.min(
                                prodImagePreview.clientWidth / this.width,
                                prodImagePreview.clientHeight / this.height
                            );
                            this.width *= ratio;
                            this.height *= ratio;
                        });

                        // Clear previous images
                        while (prodImagePreview.firstChild) {
                            prodImagePreview.removeChild(prodImagePreview.firstChild);
                        }

                        prodImagePreview.appendChild(productImage);
                    });

                    productReader.readAsDataURL(file);
                }
            }

            var prodImageAdd = document.getElementById("product-img-input");
            var prodImageEdit = document.getElementById("edit-product-img");
            var prodImagePreviewAdd = document.querySelector("#prod-add-preview");
            var prodImagePreviewEdit = document.querySelector("#prod-edit-preview");

            prodImageAdd.addEventListener("change", function (event) {
                handleFileInputChange(event, prodImagePreviewAdd);
            });

            prodImageEdit.addEventListener("change", function (event) {
                handleFileInputChange(event, prodImagePreviewEdit);
            });
        });
    </script>
    <script src="../script.js"></script>
</body>

</html>