<?php
session_start();
include "../connection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $editProductId = $_POST['edit-product-id'];
    $editProductName = $_POST['product_title'];
    $editProductPrice = $_POST['product_price'];
    $editProductBrand = $_POST['brand'];
    $editProductDescrip = $_POST['product_description'];
    $editProductDetails = $_POST['product_details'];
    $editCategoryId = $_POST['category_id'];

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

                $sql = "UPDATE products SET 
                        product_title='$editProductName', 
                        product_img='$proImage_path', 
                        brand='$editProductBrand', 
                        product_price='$editProductPrice', 
                        product_description='$editProductDescrip', 
                        product_details='$editProductDetails', 
                        category_id=$editCategoryId 
                        WHERE product_id=$editProductId";
                if ($conn->query($sql) === TRUE) {
                    $_SESSION['status'] = "Product updated successfully";
                    echo "success";
                } else {
                    $_SESSION['status'] = "Error updating product: " . $conn->error;
                    error_log("Error updating product: " . $conn->error);
                    echo "error";
                }     
            }
        }
    }
}
?>
