<?php // action.php

include "./connection.php";

if (isset($_POST['pid'])) {
    $proid = $_POST['pid'];
    $ptitle = $_POST['ptitle'];
    $pimage = $_POST['pimage'];
    $pprice = $_POST['pprice'];
    $pQty = 1;
    
    // Handle the "Add to Cart" logic
    $stmt = $conn->prepare("SELECT product_id FROM cart WHERE product_id=?");
    $stmt->bind_param("s", $proid);
    $stmt->execute();
    $res = $stmt->get_result();
    $r = $res->fetch_assoc();
    $productId = $r['product_id']; // Corrected column name

    if (!$productId) {
        $query = $conn->prepare("INSERT INTO cart (cart_product_title, cart_product_image, cart_product_price, quantity) VALUES (?, ?, ?, ?)");
        $query->bind_param("sssi", $ptitle, $pimage, $pprice, $pQty);

        $query->execute();
        echo 'Added to Cart';
    } else {
        // Product already in the cart, display alert
        echo "Product already in the cart";
    }
}

if(isset($_GET['cartCount']) && $_GET['cartCount'] === 'cartCount'){
    $stmt = $conn->prepare("SELECT * FROM cart");
    $stmt->execute();
    $stmt->store_result();
    $rows = $stmt->num_rows;

    echo $rows;
}
?>
