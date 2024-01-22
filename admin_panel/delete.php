<?php //delete php

include "../connection.php";

//Delete Category 
if (isset($_POST["action"])){
    if ($_POST["action"] == "delete"){
        delete();
    }
}

function delete(){
    global $conn;

    $categoryId = $_POST['delete_id'];
    $sql = "DELETE FROM category WHERE Id = $categoryId";
    
    if (mysqli_query($conn, $sql)) {
        echo 'success'; // Return 'success' on successful deletion
    } else {
        echo 'Error: ' . mysqli_error($conn); // Return an error message on failure
    }
}
// ////////////////////


// Delete Product
if (isset($_POST['product_id'])) {
    $productId = $_POST['product_id'];

    // Perform the delete operation
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $productId);

    $stmt->execute();
    

    $stmt->close();
} else {
    echo "error";
}
///////////////////////////////

?>