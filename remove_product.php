<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productIdToRemove = $_POST['product_id'];

    // Find the index of the product with the specified ID in the cart
    $indexToRemove = array_search($productIdToRemove, array_column($_SESSION['cart'], 'product_id'));

    // Remove the product from the cart
    if ($indexToRemove !== false) {
        unset($_SESSION['cart'][$indexToRemove]);
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindex the array
    }
}

// Redirect back to the cart page
header("Location: cart-pg.php");
exit;
?>
