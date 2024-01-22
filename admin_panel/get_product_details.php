<?php
session_start();
include "../connection.php";

if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Set the content type to JSON
        header('Content-Type: application/json');
        
        echo json_encode($row);
    } else {
        // Add debugging information
        echo json_encode(["error" => "Error fetching product details.", "stmt_error" => $stmt->error]);
    }

    $stmt->close();
}
?>
